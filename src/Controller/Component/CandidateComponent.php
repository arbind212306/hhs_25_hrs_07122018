<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class CandidateComponent extends Component {

    public function add($requestData, $company_id, $is_edit = false) {
        // pr($requestData);die;
        $status = false;
        $candidateTable = TableRegistry::getTableLocator()->get('Candidates');
        $candidate = $candidateTable->newEntity();
        if ($is_edit) {
            $candidate->id = $requestData['id'];
        }
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
        if (!empty($requestData['email'])) {
            $candidate->email = $requestData['email'];
        }
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

        if ($candidateTable->save($candidate)) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}

?>