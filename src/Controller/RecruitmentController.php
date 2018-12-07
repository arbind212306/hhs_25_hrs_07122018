<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * Class to handel recruitment process. 
 */
class RecruitmentController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Candidate');
		$this->loadComponent('PhpExcel');
    }

    /*
     * Listing 
     */

    public function index() {
        if ($this->request->is('post')) {
            $this->uploadFile($this->request->data);
            $this->Flash->success('File uploaded successfully !');
            $this->redirect(['action' => 'index']);
        }
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        // Get list of all candidate.
        // Limit ,Pagination will be added later
        $query = $candidateTable->find('all')
                ->where(['Candidates.company_id' => $company_id, 'eid_generated' => 0, 'Candidates.status' => 1])
                ->contain(['Departments', 'Designations', 'Business'])
                ->order(['Candidates.created' => 'DESC']);
        $candidateData = [];
        foreach ($query as $row) {
            if (!empty($row)) {
                $candidateData[] = $row->toArray();
            }
        }
        // Get company setting data
        $companyConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
        $query1 = $companyConfigTable->find('all')
                ->where(['company_id' => $company_id, 'type' => 'recruitment_input']);
        $company_setting = false;
        if ($company_setting = $query1->first()) {
            if (!empty($company_setting->value)) {
                $candidate_setting = json_decode($company_setting->value, true);
            }
        }
        //pr($candidateData);die;
		//$css_for_layout = ['dataTables.bootstrap.min'];
		// $script_for_layout = ['jquery.dataTables.min', 'dataTables.bootstrap.min', 'recruit'];
        $this->set(compact([/* 'css_for_layout', 'script_for_layout', */ 'candidateData', 'candidate_setting']));
    }

   
    public function add() {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            if ($this->Candidate->add($requestData, $company_id)) {
                $this->Flash->success('Candidate added successfully !');
            } else {
                $this->Flash->error('Error while adding user !');
            }
            $this->redirect($this->referer());
        }
        //---------- Designation
        $designtnTable = TableRegistry::getTableLocator()->get('Designations');
        $desigData = [];
        $q1 = $designtnTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($results = $q1->all()) {
            $desigData = $results->toArray();
        }
        //pr($desigData);die;
        // ----------Business
        $businessTable = TableRegistry::getTableLocator()->get('Business');
        $businessData = [];
        $q2 = $businessTable->find('all')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r2 = $q2->all()) {
            $businessData = $r2->toArray();
        }
        // ----------Unit----------------
        $unitTable = TableRegistry::getTableLocator()->get('Units');
        $unitData = [];
        $q3 = $unitTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r3 = $q3->all()) {
            $unitData = $r3->toArray();
        }

        // ----------Zone----------------
        $zoneTable = TableRegistry::getTableLocator()->get('Zones');
        $zoneData = [];
        $q4 = $zoneTable->find('all')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r4 = $q4->all()) {
            $zoneData = $r4->toArray();
        }

        // ----------Band----------------
        $bandTable = TableRegistry::getTableLocator()->get('Bands');
        $bandData = [];
        $q6 = $bandTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r6 = $q6->all()) {
            $bandData = $r6->toArray();
        }

        // ----------Department----------------
        $departmentTable = TableRegistry::getTableLocator()->get('Departments');
        $dptData = [];
        $q5 = $departmentTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r5 = $q5->all()) {
            $dptData = $r5->toArray();
        }

        $css_for_layout = ['lte/dataTables.bootstrap.min'];
        $script_for_layout = ['lte/jquery.dataTables.min', 'lte/dataTables.bootstrap.min', 'lte/employees'];
        $this->set(compact(['css_for_layout', 'script_for_layout', 'desigData', 'businessData', 'unitData', 'zoneData', 'dptData',
            'bandData']));
    }

    public function edit($candidate_id) {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            //pr($requestData);die;
            if ($this->Candidate->add($requestData, $company_id, true)) {
                $this->Flash->success('Candidate updated successfully !');
            } else {
                $this->Flash->error('Error while updating candidate !');
            }
            $this->redirect(['action' => 'index']);
        }
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        $query = $candidateTable->find('all')
                ->where(['Candidates.company_id' => $company_id, 'Candidates.id =' => $candidate_id]);
        if (empty($query->first())) {
            echo 'Invalid Operation !';
            die;
        }
        $cData = $query->first()->toArray();
        // 
        $cData['dob'] = date('d-m-Y', strtotime($cData['dob']));
        $this->request->data = $cData;

        //---------- Designation
        $designtnTable = TableRegistry::getTableLocator()->get('Designations');
        $desigData = [];
        $q1 = $designtnTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($results = $q1->all()) {
            $desigData = $results->toArray();
        }

        // ----------Unit----------------
        $unitTable = TableRegistry::getTableLocator()->get('Units');
        $unitData = [];
        $q3 = $unitTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r3 = $q3->all()) {
            $unitData = $r3->toArray();
        }

        // ----------Department----------------
        $departmentTable = TableRegistry::getTableLocator()->get('Departments');
        $dptData = [];
        $q5 = $departmentTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r5 = $q5->all()) {
            $dptData = $r5->toArray();
        }

        // ----------Band----------------
        $bandTable = TableRegistry::getTableLocator()->get('Bands');
        $bandData = [];
        $q6 = $bandTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        if ($r6 = $q6->all()) {
            $bandData = $r6->toArray();
        }

        $this->set(compact('desigData', 'unitData', 'dptData', 'bandData'));
        $this->render('add');
    }

    /*
     * Convert candidate to employee
     */

    public function convert() {
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            if (!empty($requestData['sel'])) {
                foreach ($requestData['sel'] as $cand) {
                    $this->generateEmpid($cand);
                    // api call 
                }
            }
        }
        $this->Flash->success('User ID generated successfully ! User/User\'s moved to employee listing.');
        echo 'Done !';
        die;
    }

    private function generateEmpid($uId) {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        $query1 = $candidateTable->find('all')
                ->where(['Candidates.id' => $uId, 'Candidates.company_id' => $company_id, 'Candidates.status' => 1, 'eid_generated' => 0]);
        if (empty($candidate = $query1->first())) {
            echo 'Invalid ID ';
            die;
        }
        // pr($candidate);die;
        // get configuration.
        $cConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
        $q1 = $cConfigTable->find('all')
                ->where(['company_id' => $company_id, 'type' => 'empid_logic']);

        $eid_configTmp = $q1->first();
        //var_dump($eid_configTmp);die;
        // read configuration
        if (!empty($eid_configTmp)) {
            $eid_config = $eid_configTmp->value;
            if (!empty($eid_config)) {
                $logic = json_decode($eid_config, true);
                //pr($logic);die;
                foreach ($logic as $ent => $ldata) {
                    // ---------------------Unit based ID generation.
                    if ($ent == 'unit_id') {
                        if (empty($candidate['unit_id'])) {
                            echo 'Unit ID missing !';
                            die;
                        }
                        $user_unit_id = $candidate['unit_id'];
                        if (empty($ldata[$user_unit_id])) { // No setting for this unit , So use default.
                            $user_unit_id = 0;
                        }
                        // Now get last used id from config ,we will +1 of that.
                        $lastid_type = 'last_eid';
                        $lastid = 0;
                        $cConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
                        $q2 = $cConfigTable->find('all')
                                ->where(['company_id' => $company_id, 'type' => $lastid_type]);
                        if (!empty($q2->first())) {
                            $lastidTmp = $q2->first()->value;
                            $lastidTmp = json_decode($lastidTmp, true);

                            if (isset($lastidTmp[$user_unit_id])) {
                                $lastid = $lastidTmp[$user_unit_id];
                            }
                        }
                        // Prepare next index 
                        $nextid = (int) $lastid + 1;
                        if (strlen($nextid) < 5) {
                            while (strlen($nextid) < 5) {
                                $nextid = "0" . $nextid;
                            }
                        }
                        $prefix = $ldata[$user_unit_id];
                        $empID = $prefix . $nextid;
                        //echo $empID;//die;
                        $checkFlag = true;
                        while ($checkFlag) {
                            if ($this->validateEid($company_id, $empID)) {
                                $checkFlag = false;
                            } else {
                                $nextid = (int) $nextid + 1;
                                if (strlen($nextid) < 5) {
                                    while (strlen($nextid) < 5) {
                                        $nextid = "0" . $nextid;
                                    }
                                }
                                $empID = $prefix . $nextid;
                            }
                        }
                        //echo $empID;die;
                        // Update config...
                        $cConfig = $cConfigTable->newEntity();
                        if (!empty($q2)) {
                            $cConfig->id = $q2->first()->id;
                        }
                        $lastidTmp[$user_unit_id] = (int) $nextid;
                        $cConfig->type = $lastid_type;
                        $cConfig->value = json_encode($lastidTmp);
                        $cConfig->company_id = $company_id;
                        $cConfigTable->save($cConfig);
                        // echo $empID;
                        // Add to employee table
                        $employeeTable = TableRegistry::getTableLocator()->get('Employees');
                        $enew = $candidate->toArray();
                        $employee = $employeeTable->newEntity($enew);

                        $employee->id = $employeeTable->getNewId();
                        $employee->emp_id = $empID;
                        $chk1 = $employeeTable->save($employee);

                        // Now save to employee details table
                        $employeeDTable = TableRegistry::getTableLocator()->get('EmployeeDetails');
                        $employeeDetail = $employeeDTable->newEntity();
                        $employeeDetail->employee_id = $chk1->id;
                        $employeeDetail->dob = $employee->dob;
                        $employeeDetail->designation_id = $employee->designation_id;
                        $employeeDetail->business_id = $employee->business_id;
                        $employeeDetail->unit_id = $employee->unit_id;
                        $employeeDetail->zone_id = $employee->zone_id;
                        $employeeDetail->c_location_id = $employee->c_location_id;
                        $employeeDetail->department_id = $employee->department_id;
                        $employeeDetail->sub_department_id = $employee->sub_department_id;
                        $employeeDetail->band_id = $employee->band_id;
                        $employeeDetail->grade_id = $employee->grade_id;
                        $employeeDetail->hiring_manager_id = $employee->hiring_manager_id;
                        $employeeDetail->supervisor_emp_id = $employee->supervisor_emp_id;
                        $employeeDetail->appraiser_id = $employee->appraiser_id;
                        $employeeDTable->save($employeeDetail);
                        // Disable in candidate table
                        $candidate->eid_generated=1;
                        $candidateTable->save($candidate);
                    }
                }
            }
        }
    }

    private function validateEid($company_id, $eid) {
        $userTable = TableRegistry::getTableLocator()->get('Employees');
        $query = $userTable->find('all')
                ->where(['company_id' => $company_id, 'emp_id' => $eid]);
        if (empty($query->first())) {
            return true;
        } else {
            return false;
        }
    }

    private function uploadFile($requestData) {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];

        $PhpExcel = $this->PhpExcel;

        if (empty($requestData['employee_sheet'])) {
            $PhpExcel->_requestError('Invalid operation !');
        }
        $tmp_loc = $requestData['employee_sheet']['tmp_name'];
        $PhpExcel->openExcel($tmp_loc);
        $total_rows = $PhpExcel->getTotalRows();
        $check = $PhpExcel->getCellValue('A1');
        if ($check != 'first_name') {
            $PhpExcel->_requestError('Invalid file uploaded !');
        }
        for ($i = 2; $i <= $total_rows; $i++) {
            $requestData1 = [];
            for ($j = 0; $j <= 17; $j++) {
                // Indx
                $alp = $PhpExcel->mapAlphabets($j);
                $indx = $PhpExcel->getCellValue($alp . '1');
                $value = $PhpExcel->getCellValue($alp . $i);
                if (!empty($value)) {
                    $requestData1[$indx] = $value;
                }
            }
            $this->Candidate->add($requestData1, $company_id);
        }
    }
    

    public function empInfo($user_id) {
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
