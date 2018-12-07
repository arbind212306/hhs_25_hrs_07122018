<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Class to handel recruitment process. 
 */
class RecruitmentController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('demo');
    }

    /*
     * Listing 
     */

    public function index() {
        $loggedUser = $this->Auth->user();
        $company_id = $loggedUser['company_id'];
        $user_id = $loggedUser['id'];

        $userDTable = TableRegistry::getTableLocator()->get('UserDetails');
        // Get list of all whose EID is not generated.
        $query = $userDTable->find('all')
                ->where(['Users.company_id' => $company_id, 'Users.id !=' => $user_id, 'emp_id' => "0"])
                ->contain(['Users', 'Departments', 'Designations']);
        $candidateData = [];
        foreach ($query as $row) {
            if (!empty($row)) {
                $candidateData[] = $row->toArray();
            }
        }
        //pr($candidateData);die;
        $css_for_layout = ['lte/dataTables.bootstrap.min'];
        $script_for_layout = ['lte/jquery.dataTables.min', 'lte/dataTables.bootstrap.min', 'lte/recruit'];
        $this->set(compact(['css_for_layout', 'script_for_layout', 'candidateData']));
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
                }
            }
        }
        echo 'Done !';
        die;
    }

    private function generateEmpid($uId) {
        $userDTable = TableRegistry::getTableLocator()->get('UserDetails');

        $userTable = TableRegistry::getTableLocator()->get('Users');
        $user = $userTable->get($uId);
        if (empty($user)) {
            echo 'Invalid ID ';
            die;
        }
        $company_id = $user['company_id'];
        // get configuration.
        $cConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
        $q1 = $cConfigTable->find('all')
                ->where(['company_id' => $company_id, 'type' => 'empid_logic']);

        $eid_configTmp = $q1->first();
        // read configuration
        if (!empty($eid_configTmp)) {
            $eid_config = $eid_configTmp->value;
            if (!empty($eid_config)) {
                $logic = json_decode($eid_config, true);
                foreach ($logic as $ent => $ldata) {
                    // ---------------------Unit based ID generation.
                    if ($ent == 'unit_id') {
                        $query2 = $userDTable->find('all')
                                ->where(['UserDetails.id !=' => $uId, 'Users.emp_id' => "0"])
                                ->contain(['Users']);
                        if (!empty($query2->first())) {
                            $udlts = $query2->first();
                            if (!empty($udlts['unit_id'])) {
                                $checkFlag = true;
                                while ($checkFlag) {
                                    $nextid = $this->getnextempid($company_id);
                                    $prefix = "";
                                    foreach ($ldata as $uid => $utext) {
                                        if ($uid == 0) {  //Default
                                            $prefix = $utext;
                                        }
                                        if ($udlts['unit_id'] == $uid) {
                                            $prefix = $utext;
                                        }
                                    }
                                    $empID = $prefix . $nextid;
                                    if ($this->validateEid($company_id, $empID)) {
                                        if (empty($user->emp_id)) {
                                            $user->emp_id = $empID;
                                            $userTable->save($user);
                                            // Update config table
                                            $cConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
                                            $cc = $cConfigTable->newEntity();
                                            $lastid_type = 'last_eid';
                                            $q1 = $cConfigTable->find('all')
                                                    ->where(['company_id' => $company_id, 'type' => $lastid_type]);

                                            if (!empty($q1->first())) {
                                                $cc->id = $q1->first()->id;
                                            } else {
                                                $cc->type = $lastid_type;
                                                $cc->company_id = $company_id;
                                            }
                                            $cc->value = intval($nextid);
                                            $cConfigTable->save($cc);
                                            $checkFlag = false; // No more looping
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //---------------------------------------------
                }
            }
        }
    }

    private function getnextempid($company_id) {
        $lastid_type = 'last_eid';
        $lastid = 0;
        $cConfigTable = TableRegistry::getTableLocator()->get('CompanyConfig');
        $q1 = $cConfigTable->find('all')
                ->where(['company_id' => $company_id, 'type' => $lastid_type]);
        if (!empty($q1->first())) {
            $lastid = $q1->first()->value;
        } else {
            $cConfig = $cConfigTable->newEntity();
            $cConfig->type = $lastid_type;
            $cConfig->value = $lastid;
            $cConfig->company_id = $company_id;
            $cConfigTable->save($cConfig);
        }
        $lastid = (int) $lastid + 1;
        if (strlen($lastid) < 5) {
            while (strlen($lastid) < 5) {
                $lastid = "0" . $lastid;
            }
        }
        return $lastid;
    }

    private function validateEid($company_id, $eid) {
        $userTable = TableRegistry::getTableLocator()->get('Users');
        $query = $userTable->find('all')
                ->where(['company_id' => $company_id, 'emp_id' => $eid]);
        if (empty($query->first())) {
            return true;
        } else {
            return false;
        }
    }

}
