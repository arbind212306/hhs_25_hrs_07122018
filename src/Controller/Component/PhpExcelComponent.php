<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class PhpExcelComponent extends Component {

    private $objPHPExcel = null, $objWorksheet = null;
    private $inputFileType = 'Excel2007';
    private $defaults = array('extension' => '.xlsx', 'excelName' => 'ExcelSheet', 'sheet1Name' => 'Sheet1');
    private $alphabets = null;

    public function initialize(array $config) {
        parent::initialize($config);
        // Load PHPExcel from vender location
        require_once ROOT . DS . 'vendor' . DS . 'PhpExcel' . DS . 'PHPExcel.php';
    }

    
    public function openExcel($excelFileName) {

        $objReader = \PHPExcel_IOFactory::createReader($this->inputFileType); // Create reader
        $objReader->setIncludeCharts(TRUE);  // If charts are avilable use them

        if (!file_exists($excelFileName)) {
            $this->_requestError('Unable to locate ' . $excelFileName . ' !');
        }
        $this->objPHPExcel = $objReader->load($excelFileName); // Make excel object, globally accessable
        $this->objWorksheet = $this->objPHPExcel->getActiveSheet(); // Make current sheet object, globally accessable

        return $this->objPHPExcel;
    }   
  
    function getCellValue($cell) {
        return $this->objWorksheet->getCell($cell)->getCalculatedValue();
    }

    function mapAlphabets($colIndex) {
        if (empty($this->alphabets)) {
            $this->alphabets(1);
        }
        if (!empty($this->alphabets[$colIndex])) {
            return $this->alphabets[$colIndex];
        } else {
            $this->_requestError('Invalid column Index passed !');
        }
    }

    function getTotalRows($column = 0) {
        $returnVal = 1;
        if (!empty($this->objWorksheet->getHighestRow($column))) {
            $returnVal = $this->objWorksheet->getHighestRow($column);
        }
        return $returnVal;
    }

    public function alphabets($level) {
        //  Alphabets Array
        $this->alphabets = $alphabets = range('A', 'Z'); // Array containing latters from A to Z
        for ($i = 0; $i < $level; $i++) {
            foreach ($alphabets as $alpha) {
                array_push($this->alphabets, $alphabets[$i] . $alpha);
            }
        }
    }

    function getExcelObj() {
        return $this->objPHPExcel;
    }  

    public function _requestError($msg) {
        echo json_encode(array('status' => 'error', 'msg' => $msg));
        die;
    }

}
