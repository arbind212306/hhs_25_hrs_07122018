<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

class EmployeesController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $user_id = $loggedUser['id'];
        $employeesTable = TableRegistry::getTableLocator()->get('Employees');
        // Get list of all.
        $query = $employeesTable->find('all')
                ->where(['Employees.company_id' => $company_id, 'Employees.id !=' => $user_id, 'Employees.status' => 1])
                ->contain(['EmployeeDetails' => ['Departments', 'Designations', 'Units', 'Business']])
                ->order(['Employees.created' => 'DESC']);
        $empData = [];
        foreach ($query as $row) {
            if (!empty($row)) {
                $empData[] = $row->toArray();
            }
        }
        //pr($empData);die;
        $css_for_layout = ['lte/dataTables.bootstrap.min'];
        $script_for_layout = ['lte/dataTables.bootstrap.min', 'lte/employees'];
        $script_for_header = ['lte/jquery.min'];
        $this->set(compact(['css_for_layout', 'script_for_layout', 'empData', 'script_for_header']));
    }

    public function empInfo($user_id) {
        $this->loadComponent('PhpExcel');
        $this->loadComponent('RequestHandler');
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        // Todo: check if current user has access to generate appointmen latter

        $userTable = TableRegistry::getTableLocator()->get('Users');
        $query = $userTable->find('all')
                ->where(['Users.id' => $user_id, 'Users.company_id' => $company_id])
                ->contain(['UserDetails' => ['Departments', 'Business', 'Units', 'Bands']]);
        if (!$joinee = $query->first()) {
            $this->Flash->error('Invalid operation !');
            $this->redirect($this->referer());
        }
        $filename = 'EmployeeInfo';
        if (!empty($joinee['emp_id'])) {
            $filename = Inflector::slug($joinee['emp_id'] . '_' . $filename);
        }
        $filename1 = Inflector::dasherize($filename);
        $this->viewBuilder()->options([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => $filename1 . '.pdf',
                'download' => true,
                'engine' => 'CakePdf.DomPdf',
            ]
        ]);
        $this->set('joinee', $joinee);
    }

}
