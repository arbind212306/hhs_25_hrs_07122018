<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class EmpPersonalController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index($emp_code = null) {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $employeesTable = TableRegistry::getTableLocator()->get('Employees');
        // Get data of this employee.
        $query = $employeesTable->find('all')
                ->where(['Employees.company_id' => $company_id, 'Employees.emp_id' => $emp_code])
                ->contain(['EmployeeDetails' => ['Departments', 'Designations', 'Units', 'Business']]);
        if (!$employee = $query->first()) {
            $this->Flash->error('Invalid ID !');
            $this->redirect($this->referer());
        }
        //pr($employee);die;
        // Handel any post data
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            $emp_edited = $employeesTable->newEntity($requestData);
            $emp_edited->id = $employee->id;
            if ($employeesTable->save($emp_edited)) {
                // Also save data to employee details table
                $employeeDTable = TableRegistry::getTableLocator()->get('EmployeeDetails');
                $empd_edited = $employeeDTable->newEntity($requestData);
                //var_dump($employeeDTable->getNewId());die;
                if (!empty($employee['employee_detail']['id'])) { // Data already exists
                    $empd_edited->id = $employee['employee_detail']['id'];
                } else {  // New
                    $empd_edited->id = null;
                }
                $employeeDTable->save($empd_edited);
                $this->Flash->success('Employee information edited successfully !');
            } else {
                $this->Flash->error('Error while updating employee !');
            }
            $this->redirect($this->referer());
        }

        // Get other data
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
        // Set other tabs data
        $this->setContactData($employee->id);
        $this->setEmergencyContact($employee->id);

        $this->set(compact('employee', 'desigData', 'businessData', 'unitData', 'zoneData', 'bandData', 'dptData'));
    }

    /*
     * Function to edit personal or reportee profile
     * 
     */

    public function edit($reportee_id = null) {
        
    }

    public function contactDetails() {
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $requestData = $this->request->data;
            //pr($requestData);die;
            //------------------------ Company must be same, Do validation-------------------
            $loggedUser = $this->Auth->user();
            $company_id = $loggedUser['company_id'];
            $employeesTable = TableRegistry::getTableLocator()->get('Employees');
            if (($check_company_id = $employeesTable->getCompanyIdOfEmployee($requestData['employee_id'])) && ($check_company_id == $company_id)) {
                $empContactTable = TableRegistry::getTableLocator()->get('EmployeeContactAddresses');
                $eca = $empContactTable->newEntity($requestData);
            } else {
                $this->Flash->error('Invalid operation !');
                $this->redirect($this->referer());
            }
            //-------------------------------------------------------
            if (!empty($requestData['key'])) {
                $eca->id = $requestData['key'];
            }
            if ($empContactTable->save($eca)) {
                $this->Flash->success('Contact information edited successfully !');
                $this->redirect($this->referer());
            }
        }
        $this->redirect($this->referer());
    }

    public function contactEmergency() {
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $requestData = $this->request->data;
            //pr($requestData);die;
            //------------------------ Company must be same, Do validation-------------------
            $loggedUser = $this->Auth->user();
            $company_id = $loggedUser['company_id'];
            $employeesTable = TableRegistry::getTableLocator()->get('Employees');
            if (($check_company_id = $employeesTable->getCompanyIdOfEmployee($requestData['employee_id'])) && ($check_company_id == $company_id)) {
                $empContactETable = TableRegistry::getTableLocator()->get('EmployeeEmergencyContacts');
                $ece = $empContactETable->newEntity($requestData);
            } else {
                $this->Flash->error('Invalid operation !');
                $this->redirect($this->referer());
            }
            //-------------------------------------------------------
            if (!empty($requestData['key'])) {
                $ece->id = $requestData['key'];
            }
            if ($empContactETable->save($ece)) {
                $this->Flash->success('Contact information edited successfully !');
                $this->redirect($this->referer());
            }
        }
        $this->redirect($this->referer());
    }

    private function setContactData($employee_id) {
        // Previously saved data
        $empContactTable = TableRegistry::getTableLocator()->get('EmployeeContactAddresses');
        $q0 = $empContactTable->find('all')
                ->where(['employee_id' => $employee_id, 'status' => 1]);
        $contactData = [];
        foreach ($q0 as $r1) {
            if (!empty($r1)) {
                $contactData[] = $r1->toArray();
            }
        }
        // ----------Countries----------------
        $countryTable = TableRegistry::getTableLocator()->get('Countries');
        $countries = [];
        $q1 = $countryTable->find('list');
        if ($r1 = $q1->all()) {
            $countries = $r1->toArray();
        }
        // ----------States----------------
        $stateTable = TableRegistry::getTableLocator()->get('States');
        $states = [];
        $q2 = $stateTable->find('list');
        if ($r2 = $q2->all()) {
            $states = $r2->toArray();
        }
        $this->set(compact('countries', 'states', 'contactData'));
    }

    private function setEmergencyContact($employee_id) {
        // Previously saved data
        $empContactETable = TableRegistry::getTableLocator()->get('EmployeeEmergencyContacts');
        $q0 = $empContactETable->find('all')
                ->where(['employee_id' => $employee_id, 'status' => 1]);
        if (!empty($q0->first())) {
            $contactEData = $q0->first()->toArray();
        }
        $this->set(compact('contactEData'));
    }

}
