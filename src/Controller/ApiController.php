<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Class to respond api calls from outside. 
 */
class ApiController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['handler', 'index', 'checkUnique']);
    }

    public function index() {
        $csrf_token = $this->request->getParam('_csrfToken');
        $this->set([
            'token' => $csrf_token,
            '_serialize' => ['token']
        ]);
    }

    public function handler() {

        $company_id = 1; // Will get later from session Or from username passed in params
        $status = false;
        $message = "";
        $requestData = $this->request->data;
        //pr($requestData);die;
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        $candidate = $candidateTable->newEntity();

//        if (!empty($requestData['title'])) {
//            $user->title = $requestData['title'];
//        }
        if (!empty($requestData['first_name'])) {
            $candidate->first_name = $requestData['first_name'];
        }
        if (!empty($requestData['middle_name'])) {
            $candidate->middle_name = $requestData['middle_name'];
        }
        if (!empty($requestData['last_name'])) {
            $candidate->last_name = $requestData['last_name'];
        }

        // Check if already exists
        $valid = false;
        if (!empty($requestData['email'])) {
            if ($this->checkUnique($company_id, 'email', $requestData['email'])) {
                $valid = true;
            } else {
                $message = 'Candidate with this email already exists !';
                $status = false;
            }
            $candidate->email = $requestData['email'];
        }

        if ($valid) {  // valid so go ahead
            $candidate->company_id = $company_id;

            if (!empty($requestData['dob'])) {
                $candidate->dob = date('Y-m-d', strtotime($requestData['dob']));
            }
            if (!empty($requestData['mrf_id'])) {
                $candidate->mrf_id = $requestData['mrf_id'];
            }
            if (!empty($requestData['recruitment_id'])) {
                $candidate->recruitment_id = $requestData['recruitment_id'];
            }
            if (!empty($requestData['designation_id'])) {
                $candidate->designation_id = $requestData['designation_id'];
            }
            if (!empty($requestData['business_id'])) {
                $candidate->business_id = $requestData['business_id'];
            }
            if (!empty($requestData['unit_id'])) {
                $candidate->unit_id = $requestData['unit_id'];
            }
            if (!empty($requestData['zone_id'])) {
                $candidate->zone_id = $requestData['zone_id'];
            }
            if (!empty($requestData['c_location_id'])) {
                $candidate->c_location_id = $requestData['c_location_id'];
            }
            if (!empty($requestData['department_id'])) {
                $candidate->department_id = $requestData['department_id'];
            }
            if (!empty($requestData['sub_department_id'])) {
                $candidate->sub_department_id = $requestData['sub_department_id'];
            }
            if (!empty($requestData['band_id'])) {
                $candidate->band_id = $requestData['band_id'];
            }
            if (!empty($requestData['grade_id'])) {
                $candidate->grade_id = $requestData['grade_id'];
            }
            if (!empty($requestData['hiring_manager_id'])) {
                $candidate->hiring_manager_id = $requestData['hiring_manager_id'];
            }
            if (!empty($requestData['appraiser_id'])) {
                $candidate->appraiser_id = $requestData['appraiser_id'];
            }
            // Associations data
            if ($candidateTable->save($candidate)) {
                $message = 'Candidate added successfully !';
                $status = true;
            } else {
                $message = 'Error while saving user!';
                $status = false;
            }
        }
        $this->set([
            'message' => $message,
            'status' => $status,
            '_serialize' => ['message', 'status']
        ]);
    }

    private function checkUnique($company_id, $field, $value) {
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        $query = $candidateTable->find('all')
                ->where(['Candidates.' . $field => trim($value), 'Candidates.company_id' => $company_id]);
        if (!empty($query->first())) {
            return false;
        } else {
            return true;
        }
    }

}
