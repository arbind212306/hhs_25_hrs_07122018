<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class CompanyAdminsController extends AppController {
 
    public function initialize() {
        parent::initialize();
    }

    // Page to show all links
    public function index() {
        
    }

    public function accessMap() {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $employeesTable = TableRegistry::getTableLocator()->get('Employees');
        $query0 = $employeesTable->find('all')
                ->where(['Employees.company_id' => $company_id, 'Employees.status' => 1])
                ->contain(['UserRights']);
        $userRights = $query0->all();
        $userRights = $userRights->toArray();
        $this->set(compact('userRights'));
    }

    /*
     * (TODO) By default only top admin can access this location.
     */

    public function setAccess($userRoleid) {
		
		
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $userRightsTable = TableRegistry::getTableLocator()->get('UserRights');
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            if (!empty($requestData['menu']) && (!empty($requestData['u_right_id']))) {
                $query0 = $userRightsTable->find('all')
                        ->where(['UserRights.id' => $requestData['u_right_id'], 'Employees.company_id' => $company_id, 'UserRights.status' => 1])
                        ->contain(['Employees']);
                if (empty($userRightObj = $query0->first())) {
                    $this->Flash->error('Invalid operation !');
                    $this->redirect($this->referer());
                }
                $uREnt = $userRightsTable->newEntity();
                $uREnt->id = $userRightObj['id'];
                $uREnt->access = json_encode($requestData['menu']);
                if ($userRightsTable->save($uREnt)) {
                    $this->Flash->success('Access updated successfully !');
                } else {
                    $this->Flash->error('Error while updating access');
                }
                $this->redirect(['action' => 'accessMap']);
            }
        }
        $query = $userRightsTable->find('all')
                ->where(['UserRights.id' => $userRoleid, 'Employees.company_id' => $company_id, 'UserRights.status' => 1])
                ->contain(['Employees']);
        if (empty($userRight = $query->first())) {
            $this->Flash->error('Invalid operation !');
            $this->redirect($this->referer());
        }
        //pr($userRight);die;
        $allowed_menus = json_decode($userRight['access'], true);
        // Get all menus
        $menuTable = TableRegistry::getTableLocator()->get('Menus');
        $query2 = $menuTable->find('threaded')
                ->where(['status' => 1]);
        $menu = [];
        foreach ($query2 as $rw) {
            if (!empty($rw)) {
                $rEle = $rw->toArray();
                if (!empty($rEle['children'])) {
                    foreach ($rEle['children'] as $key => $rc) {
                        if ((!empty($allowed_menus)) && in_array($rc['id'], $allowed_menus)) {
                            $rEle['children'][$key]['allowed'] = true;
                        } else {
                            $rEle['children'][$key]['allowed'] = false;
                        }
                    }
                }
				else{
					
					if ((!empty($allowed_menus)) && in_array($rEle['id'], $allowed_menus)) {
                            $rEle['allowed'] = true;
                        } else {
                            $rEle['allowed'] = false;
                        }
					
					
				}
                $menu[] = $rEle;
            }
        }
        //pr($userRight);die;
        //pr($menu);die;
        $this->set(compact('userRight', 'menu'));
    }

    public function addAccess($emp_id) {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $userRightsTable = TableRegistry::getTableLocator()->get('UserRights');
        $employeesTable = TableRegistry::getTableLocator()->get('Employees');
        $empD = $employeesTable->find('all')
                ->where(['Employees.id' => $emp_id, 'Employees.status' => 1, 'Employees.company_id' => $company_id]);
        if (!$employee = $empD->first()) {
            $this->Flash->error('Invalid operation !');
            $this->redirect($this->referer());
        }
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            //pr($requestData);die;
            if (!empty($requestData['menu'])) {

                $this->tmpData($employee['id']);
                $uREnt = $userRightsTable->newEntity();
                $uREnt->access = json_encode($requestData['menu']);
                $uREnt->userid = $employee['id'];
                $uREnt->company_id = $company_id;
                $uREnt->status = 1;
                if ($userRightsTable->save($uREnt)) {
                    $this->Flash->success('Access updated successfully !');
                } else {
                    $this->Flash->error('Error while updating access');
                }
                $this->redirect(['action' => 'accessMap']);
            }
        }

        // Get all menus
        $menuTable = TableRegistry::getTableLocator()->get('Menus');
        $query2 = $menuTable->find('threaded')
                ->where(['status' => 1]);
        $menu = [];
        foreach ($query2 as $rw) {
            if (!empty($rw)) {
                $rEle = $rw->toArray();
                if (!empty($rEle['children'])) {
                    foreach ($rEle['children'] as $key => $rc) {
                        if ((!empty($allowed_menus)) && in_array($rc['id'], $allowed_menus)) {
                            $rEle['children'][$key]['allowed'] = true;
                        } else {
                            $rEle['children'][$key]['allowed'] = false;
                        }
                    }
                }
                $menu[] = $rEle;
            }
        }
        //pr($userRight);die;
        //pr($menu);die;
        $new = true;
        $user = $employee;
        $this->set(compact('menu', 'new', 'user'));
        $this->render('set_access');
    }

    private function tmpData($emp_id) {
        $employeesTable = TableRegistry::getTableLocator()->get('Employees');
//        $empD = $employeesTable->find('all')
//                ->where(['Employees.id' => $emp_id, 'Employees.status' => 1]);
        $eEntity=$employeesTable->get($emp_id);
        $eEntity->password='pass';
        $eEntity->username=$eEntity->email;
        $employeesTable->save($eEntity);
        
        $conn = ConnectionManager::get('default');
        $q = "insert into `leave_balance` (`id`,`company_id`,`leave_type`,`leave_reason`,`emp_id`,`credit`,`debit`,`status`,`addedon`,`addedby`,`ip`) values ( NULL,'1','3',NULL,'".$eEntity->emp_id."','6.000','0.000','1','2018-10-01 15:34:06',NULL,NULL)";
        $conn->execute($q);
        
    }

    public function generalSetting() {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $companyConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
        $companyTable = TableRegistry::getTableLocator()->get('Company');
        // Get company info
        $company = $companyTable->get($company_id);
        // Get setting for company    
        $query = $companyConfigTable->find('all')
                ->where(['company_id' => $company_id]);
        $company_settings = [];
        $id_mapping = [];
        foreach ($query as $rw) {
            if (!empty($rw)) {
                $company_settings[] = $rw->toArray();
                $id_mapping[$rw->type] = $rw->id;
            }
        }
        //pr($id_mapping);die;
        if ($this->request->is('post')) {
            $requestData = $this->request->data;
            //pr($requestData);die;
            if (!empty($requestData['form_type'])) {
                $form_type = $requestData['form_type'];
                $cconfig_entity = $companyConfigTable->newEntity();
                $flag = false;
                if ($form_type == 'recruitment_input') {  // Candidate input
                    if (!empty($id_mapping['recruitment_input'])) {
                        $cconfig_entity->id = $id_mapping['recruitment_input'];
                    }
                    $value = null;
                    if (!empty($requestData['cnd_input_type'])) {
                        $value = json_encode($requestData['cnd_input_type']);
                    }
                    $cconfig_entity->type = 'recruitment_input';
                    $cconfig_entity->value = $value;
                    $cconfig_entity->company_id = $company_id;
                    if ($companyConfigTable->save($cconfig_entity)) {
                        $flag = true;
                    }
                }
                if ($form_type == 'hirchy_top_band') {  // hierarchy setting
                    if (!empty($id_mapping['recruitment_input'])) {
                        $cconfig_entity->id = $id_mapping['hirchy_top_band'];
                    }
                    $value = null;
                    if (!empty($requestData['top_band'])) {
                        $value = $requestData['top_band'];
                        $cconfig_entity->type = 'hirchy_top_band';
                        $cconfig_entity->value = $value;
                        $cconfig_entity->company_id = $company_id;
                        if ($companyConfigTable->save($cconfig_entity)) {
                            $flag = true;
                        }
                    }
                }
                if ($flag) {
                    $this->Flash->success('Configuration updated successfully !');
                    $this->redirect($this->referer());
                } else {
                    $this->Flash->error('Error while updating configuration !');
                    $this->redirect($this->referer());
                }
            }
        }
        //pr($company);die;
        //pr($company_settings);die;
        // Other data required for view
        // 1:Bands
        $bandTable = TableRegistry::getTableLocator()->get('Bands');
        $query2 = $bandTable->find('list')
                ->where(['company_id' => $company_id, 'status' => 1]);
        $bandList = [];
        if ($bdata = $query2->all()) {
            $bandList = $bdata->toArray();
        }
        //pr($bandList);die;
        $this->set(compact('company_settings', 'company', 'bandList'));
    }
	
	public function employeeIdMaster(){
		 
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $companyConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
 		$form_type = null;

        if ($this->request->is('post')) {
            $requestData = $this->request->data;  
			$form_type = $requestData['form_type'];
			$employee_logic_data = array();
			$employee_logic_data = $requestData['employee_id_logic'];
		  
			if(empty($requestData['employee_id_logic'])){
				$this->Flash->error('Please enter employee Id logics!'); 
				$this->redirect($this->referer());
			}
            if ($form_type == 'empid_logic') {    
 				$exists = $companyConfigTable->exists(['type' => 'empid_logic']);
				$employee_id_master_logic_data = json_encode($employee_logic_data);
				 
				if($exists){
					//update the entity
					/*$employee_id_master_config = $companyConfigTable->newEntity(); 
					$employee_id_master_config = $companyConfigTable->where(['type'=>'empid_logic'])->first();
 					$employee_id_master_config->type = 'empid_logic';
					$employee_id_master_config->value = $employee_id_master_logic_data;
					$employee_id_master_config->company_id =  isset($company_id)?$company_id:"1"; 

					if ($companyConfigTable->save($employee_id_master_config)) {					 
							$this->Flash->success('Configuration updated successfully !');
							$this->redirect($this->referer());   
					}  else {
							$this->Flash->error('Error while updating configuration !');
							$this->redirect($this->referer()); 
					}*/
					$this->redirect($this->referer()); 
				} else {
					// now create a new entity in the config table
					$employee_id_master_config = $companyConfigTable->newEntity(); 
					$employee_id_master_config->type = 'empid_logic';
					$employee_id_master_config->value = $employee_id_master_logic_data;
					$employee_id_master_config->company_id =  isset($company_id)?$company_id:"1"; 
					if ($companyConfigTable->save($employee_id_master_config)) {
						$this->Flash->success('Configuration updated successfully !');
						$this->redirect($this->referer());  
					}  else {
						$this->Flash->error('Error while updating configuration !');
						$this->redirect($this->referer()); 
					}
				}
            } 
		}
		
		$this->render('employee_id_master');
	}

}
