<?php

/* 
 * This is the main controller of exit module.
 */

namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class ExitController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadModel('ExitResignation');
    }
   
   /*method for alerting user when cliks on apply resignation button*/
    public function warnResignation(){
        $user = $this->Auth->user();
       // pr($user);
        $id = $user['id'];
        $name = $user['first_name'].' '.$user['middle_name'].' '.$user['last_name'];
        $email = $user['email'];
        $noOfWorkingDays = $this->ExitResignation->getNumberOfEmployeesWorkingDays($id);
        $this->set(compact('name','noOfWorkingDays','allowed_menu'));
    }
    
    /*
     * method resignation when user clicks on
     * apply resignation
     */
    public function applyResignation(){
        $user = $this->Auth->user();
       // pr($user);
        $id = $user['id'];
        $name = $user['first_name'].' '.$user['middle_name'].' '.$user['last_name'];
        $emp_id = $user['emp_id'];
        $email = $user['email'];
        $current_date =  date('Y-m-d');
        $exit_reason = $this->ExitResignation->getExitReason();
        $data = $this->ExitResignation->getNoticeDetails($id);
        // pr($data);
        $notice_period = $data['notice_period'] - 1;
        $lastWorkingDay = date('d-m-Y', strtotime("$current_date +$notice_period  days"));
        $this->set(compact('name','emp_id','email','allowed_menu','data','lastWorkingDay','exit_reason'));
    }
    
    /*
     * method to generate disscussion request to spervisor
     */
    public function exitDiscussion(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $discussed_text = addslashes($this->request->data('discuss_txt'));
            $emp_id = $this->request->data('employee_id');
            //code to check if request has alredy been applied or not
            $check = $this->ExitResignation->checkStausForSameDisscussRequest($emp_id);
            if($check){
                $msg = 'Your request has already been generated.';
            }
            else{
                //code to generate exit disscussion request
                $msg = $this->ExitResignation->exit_discussion($emp_id,$discussed_text);
            }
            echo $msg;
        }
    }
    
    /*
     * method to generate resignation request
     */
    public function exitResignation(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $current_date = date('Y-m-d H:i:s');
            $status = 1;
            $get_request_date = $this->request->data('exit_datepicker');
            if(empty($get_request_date)){
                $separationDate = date('Y-m-d', strtotime($this->request->data('last_working_day')));
            }else{
                $separationDate = date('Y-m-d', strtotime($this->request->data('exit_datepicker')));
            }
            $employee_id = $this->request->data('emp_id');
            $resignText = addslashes($this->request->data('resign_text'));
            $exitReason = $this->request->data('exit_reson');
            $serveNoticePeriod = $this->request->data('serve_notice_period');
            $shortFallDays = $this->request->data('shortfall_day');
            $rqst_for_last_working_days = date('Y-m-d', strtotime($requestForLastWorkingDay));
            $reasonForLastWorkingDay = addslashes($this->request->data('reason_for_lastworking_day'));
            $arr = ['emp_id'=>$employee_id,'resignation_text'=>$resignText,'serve_notice_period'=>$serveNoticePeriod,
                'exit_reason'=>$exitReason,'reason_for_last_working_day'=>$reasonForLastWorkingDay,
                'separation_date'=>$separationDate,'created_date'=>$current_date,'modified_date'=>$current_date,
                'appraiser_status'=>$status,'status'=>$status,'hrstatus'=>$status,'reviewer_status'=>$status];
            $check = $this->ExitResignation->checkStausForSameResignationRequest($employee_id);
            if($check){
                $msg = 'You have alredy applied for resignation.';
            }
            else{
            $msg = $this->ExitResignation->exit_resignation($arr);
            }
            echo $msg;
        }
    }
    
    /* method for displaying employee discussion message to appraiser in details*/
    public function viewDisscussedDetails($id){
        if(!empty($id)){
            $r = explode('_',$id); //convert string to array
            $id = base64_decode($r[1]);
            $user = $this->Auth->user();
            $logged_user_id = $user['id'];
//            $band = $this->ExitResignation->getBand();
            $logged_user_roles = $this->ExitResignation->getRoleId($logged_user_id);
            $role = $logged_user_roles[0]['role_id'];
            switch ($role){
                case 3:
                   $data = $this->ExitResignation->getDisscussedDetails($id);
                    break;
                case 4:
                    $data = $this->ExitResignation->getDiscusseddetailsToReviewer($id);
                    break;
                case 6:
                    $data = $this->ExitResignation->getDiscusseddetailsToHR($id);
                    break;
            }
//            echo '<pre>';
//            var_dump($data);
//            echo '</pre>';
            $this->set(compact('data','id' ,'email','role'));
            
        }
    }
    
    /* method for inserting appraiser discussion with employee*/
    public function appraiserDisscussedText(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $emp_id = $this->request->data('hidden_emp_id');
            $disscuss_text = addslashes($this->request->data('appraiser_text'));
            $id = $this->request->data('hidden_id');
            $data = $this->ExitResignation->insertAppraiserDisscussion($emp_id,$disscuss_text,$id);
            echo $data;
        }
    }
    
    /*
     * method for inserting reviewer discussed text/comments 
     * against discussion between employee and supervisor
     */
    public function reviwerDiscussedText(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $emp_id = $this->request->data('hidden_emp_id');
            $disscuss_text = addslashes($this->request->data('reviewer_text'));
            $id = $this->request->data('hidden_id');
            $data = $this->ExitResignation->insertReviewerDisscussion($emp_id,$disscuss_text,$id);
            echo $data;
        }
    }
    
    /*method starts here for inserting HR manager discuss text/comments */
    public function hrDisscussedText(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $emp_id = $this->request->data('hidden_emp_id');
            $disscuss_text = addslashes($this->request->data('hr_text'));
            $id = $this->request->data('hidden_id');
            $data = $this->ExitResignation->insertHrDisscussion($emp_id,$disscuss_text,$id);
            echo $data;
        }
    }
    
    /* method for dispalying employee resignation in details */
    public function viewResignationDetails($id){
        if(!empty($id)){
            $r = explode('_',$id); //convert string to array
            $id = base64_decode($r[1]);
            $user = $this->Auth->user();
            $logged_user_id = $user['id'];
//            $band = $this->ExitResignation->getBand();
            $logged_user_roles = $this->ExitResignation->getRoleId($logged_user_id);
            $role = $logged_user_roles[0]['role_id'];
            $supervisor_name = '';
            switch ($role){
                case 3:
                    $data = $this->ExitResignation->getResignationDetails($id);
                    $this->setValueForResignationOnView($data,$id);
                    break;
                case 4:
                    $data = $this->ExitResignation->getAppraiserCommentAgainstResignation($id);
                    if($data['appraiser_status'] == 5){
                        $supervisor_name = $this->ExitResignation->getFewEmployeeDetails($data['appraiser_id']);
                    }
                    $this->setValueForResignationOnView($data,$id,$supervisor_name);
                    $this->render('view_resignation_details_by_reviewer');
                    break;
                case 6:
                    $data = $this->ExitResignation->getAppraiserCommentAgainstResignation($id);
                    if($data['appraiser_status'] == 5){
                        $supervisor_name = $this->ExitResignation->getFewEmployeeDetails($data['appraiser_id']);
                    }
                    $this->setValueForResignationOnView($data,$id,$supervisor_name);
                    $this->render('view_resignation_details_by_hr');
                    break;
            }
//            echo '<pre>';
//            var_dump($data);
//            echo '</pre>';
//            
        }
    }
    
    /*method for setting values to ctp files based on passed argument for viewin resignation details*/
    public function setValueForResignationOnView($data,$id,$supervisor_name=""){
        $exit_reason = $this->ExitResignation->getExitReason();
        $notice_details = $this->ExitResignation->getNoticeDetails($data['employee_id']);
        $notice_period = $notice_details['notice_period'];
        $current_date =  date('Y-m-d');
        $separation_date = date('d-F-Y', strtotime($data['separation_date']));
        $lastWorkingDay = date('d-F-Y', strtotime("$current_date +$notice_period days"));
        $this->set(compact('data','id','lastWorkingDay','notice_details','allowed_menu','exit_reason',
                'separation_date','supervisor_name'));
    }
    
    /*method for inserting approved resignation by supervisor*/
    public function appraiserApprovedResignation(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->data('id');
            $emp_id = $this->request->data('emp_id');
            $appraiser_status = $this->request->data('retain_option');
            $hold_salary = $this->request->data('hold_salary');
            $waiver_notice_pay = $this->request->data('waiver_notice_pay');
            $appraiser_comments = addslashes($this->request->data('retention_comments'));
            $last_date = $this->request->data('last_working_day');
            $separation_date = date('Y-m-d', strtotime($last_date));
            $serve_notice_period = $this->request->data('serve_notice_period');
            $data = $this->ExitResignation->insertAppraiserApprovedResignation($id,$emp_id,$appraiser_status,
                    $hold_salary,$waiver_notice_pay,$appraiser_comments,$separation_date,$serve_notice_period);
            echo $data;
        }
    }
    
    /*method for inserting approved/retain resignation request by Reviewer*/
    public function reviewerApprovedResignation(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->data('id');
            $emp_id = $this->request->data('emp_id');
            $reviewer_status = $this->request->data('retain_option');
            $hold_salary = $this->request->data('hold_salary');
            $waiver_notice_pay = $this->request->data('waiver_notice_pay');
            $reviewer_comments = addslashes($this->request->data('reviewer_comments'));
            $last_date = $this->request->data('last_working_day');
            $separation_date = date('Y-m-d', strtotime($last_date));
            $serve_notice_period = $this->request->data('serve_notice_period');
            $data = $this->ExitResignation->reviewerResignationComment($id,$emp_id,$reviewer_status,$hold_salary,
                    $waiver_notice_pay,$reviewer_comments,$separation_date,$serve_notice_period);
            echo $data;
        }
    }


    /*method for inserting resignation request Approved/retained HR Manager of employees*/
    public function hrApprovedResignation(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->data('id');
            $emp_id = $this->request->data('emp_id');
            $hr_status = $this->request->data('retain_option');
            $hold_salary = $this->request->data('hold_salary');
            $waiver_notice_pay = $this->request->data('waiver_notice_pay');
            $hr_comments = $this->request->data('retention_comments');
            $last_date = $this->request->data('last_working_day');
            $separation_date = date('Y-m-d', strtotime($last_date));
            $serve_notice_period = $this->request->data('serve_notice_period');
            $data = $this->ExitResignation->insertHrManagerApprovedResignation($id,$emp_id,$hr_status,
                    $hold_salary,$waiver_notice_pay,$hr_comments,$separation_date,$serve_notice_period);
            echo $data;
        }
    }
    
    /* method for initiate resignation */
    public function initiateResignation(){
        $user = $this->Auth->user();
        $emp_id = $user['emp_id'];
        $user_id = $user['id'];
        $logged_user_roles = $this->ExitResignation->getRoleId($user_id);
        $allRoles = $this->ExitResignation->getAllRoles();
        $role_id = $logged_user_roles[0]['role_id'];
        $company_id = $logged_user_roles[0]['company_id'];
        if($role_id == 3){
//            $absconding = $this->ExitResignation->getAbsconding();
//           $resignArr = $this->ExitResignation->getAllAppliedResignation($emp_id);
           $arr = $this->ExitResignation->getAllEmployeeForParticularSupervisior($emp_id,$user_id);
           $data = $this->fetchLocationBusinessDetails($arr);
        }
        $this->set(compact('data'));
    }
    
    /* method to initiate requset */
    public function initiateRequest($id){
        if(!empty($id)){
            $r = explode('_',$id); //convert string to array
            $id = base64_decode($r[1]);
            $data = $this->ExitResignation->getFewEmployeeDetails($id);
            $exit_reason = $this->ExitResignation->getExitReason();
            $this->set(compact('data','id','exit_reason'));
            
        }
    }

    public function addDiscussion(){
        $user = $this->Auth->user();
        $id = $user['id'];
        $name = $user['first_name'].' '.$user['middle_name'].' '.$user['last_name'];
        $emp_id = $user['emp_id'];
        $email = $user['email'];
        $noOfWorkingDays = $this->ExitResignation->getNumberOfEmployeesWorkingDays($id);
        $this->set(compact('name','noOfWorkingDays','emp_id','email','allowed_menu'));
    }

    /*method for initiating resignation request by supervior of their employees*/
    public function initiateResignationBySupervisior(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $current_date =  date('Y-m-d H:i:s');
//            $appraiser_status = 2;
//            $status = 1;
            $id = $this->request->data('id');
            $emp_id = $this->request->data('emp_id');
            $resign_date = $this->request->data('resignation_date');
            $resignation_date = date('Y-m-d H:i:s', strtotime("$resign_date"));
            $hold_salary = $this->request->data('hold_salary');
            $separation = $this->request->data('separation_date');
            $separation_date = date('Y-m-d H:i:s', strtotime("$separation"));
            $exit_reason = $this->request->data('exit_reason');
            $serve_notice_period = $this->request->data('serve_notice_period');
            $waiver_notice_pay = $this->request->data('waiver_notice_pay');
            $get_comments = $this->request->data('get_comments');
            $arr = [$emp_id,$get_comments,$serve_notice_period,$exit_reason,$get_comments,
                $resignation_date,$separation_date,$current_date,$current_date,$appraiser_status,
                $hold_salary,$waiver_notice_pay,$status];
            $data = $this->ExitResignation->initiateResignation($emp_id,$exit_reason,$resignation_date,
                  $separation_date,$current_date,$hold_salary,$waiver_notice_pay,$get_comments,$serve_notice_period);  
            echo $data;
        }
    }

    /*method for showing all employees for absconding/termination purpose*/
    public function initiateAbscondingTermination(){
        $user = $this->Auth->user();
        $emp_id = $user['emp_id'];
        $id = $user['id'];
        $allRoles = $this->ExitResignation->getAllRoles();
        $logged_user_roles = $this->ExitResignation->getRoleId($id);
        $role = $logged_user_roles[0]['role_id'];
        $employeeDetails = $this->ExitResignation->getEmployeeDetails($id);
        switch($role){
            case 3:
                $allEmployess = $this->ExitResignation->getAllEmployeesNotAppliedResignation($id,$emp_id);
                $data = $this->fetchLocationBusinessDetails($allEmployess);
                break;
            case 4:
                $allEmployess = $this->ExitResignation->getAllAbscondingTerminationToReviewer($emp_id);
                $data = $this->fetchLocationBusinessDetails($allEmployess);
                break;
            case 6:
                $allEmployes = $this->ExitResignation->getAllTerminationRequestToHR($employeeDetails['department_id']);
                $data = $this->fetchLocationBusinessDetails($allEmployes);
        }
        $this->set(compact('data'));
    }
    
    /*method for initiating absconding request*/
    public function initiateAbsconding($id){
        if(!empty($id)){
            $r = explode('_',$id); //convert string to array
            $id = base64_decode($r[1]);
            $user = $this->Auth->user();
            $emp_id = $user['emp_id'];
            $user_id = $user['id'];
            $absconding_reason = $this->ExitResignation->getAbscondingTerminationReason();
            $allRoles = $this->ExitResignation->getAllRoles();
            $logged_user_roles = $this->ExitResignation->getRoleId($user_id);
            $role = $logged_user_roles[0]['role_id'];
            switch($role){
                case 3:
                    $data = $this->ExitResignation->getFewEmployeeDetails($id);
                    $this->set(compact('data','id','absconding_reason'));
                    break;
                case 4:
                    $data = $this->ExitResignation->getAbscondingTerminationDetails($id);
                    $get_appraiser_name = $this->ExitResignation->getAppraiserName($data['emp_id']);
                    $this->set(compact('data','id','absconding_reason','get_appraiser_name'));
                    $this->render('initiate_absconding_by_reviewer');
                    break;
                case 6:
                    $data = $this->ExitResignation->getAbscondingTerminationDetailsToHR($id);
                    $get_appraiser_name = $this->ExitResignation->getEmployeeBasedOnEmpid($data['supervisor_emp_id']);
                    $this->set(compact('data','id','absconding_reason','get_appraiser_name'));
                    $this->render('initiate_absconding_by_hr');
                    break;
            }
        }
    }
    
    /*method for raising absconding/termination request and inserting deatils to database*/
    public function raiseAbscondingTerminationRequest(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $status = 1;
            $emp_id = $this->request->data('hidden_empid');
            $process = $this->request->data('process');
            $terminate_reason = $this->request->data('terminate_reason');
            $separation_date = date('Y-m-d H:i:s', strtotime($this->request->data('separation_date')));
            $remark = $this->request->data('remark');
            $data = $this->ExitResignation->raiseTerminationrequest($emp_id,$process,$terminate_reason,
                    $separation_date,$remark,$status);
            echo $data;
        }
    }
    
    /*method for approving absconded/terminated request by reviewer*/
    public function approveAbscondingTerminationReviewer(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->data('hidden_id');
            $exit_reason = $this->request->data('exit_reason_reviewer');
            $reviewer_comment = $this->request->data('reviewer_comment_abscond');
            $data = $this->ExitResignation->approveAbscondingByReviewer($id,$exit_reason,$reviewer_comment);
            echo $data;
        }
    }
    
    /*method for approving absconded/terminated request by HR manager*/
    public function approveAbscondingTerminationHR(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->data('hidden_id');
            $emp_id = $this->request->data('hidden_emp_id');
            $exit_reason = $this->request->data('exit_reason_hr');
            $hr_comment = $this->request->data('hr_comment_abscond');
            $data = $this->ExitResignation->approveAbscondingByHR($id,$exit_reason,$hr_comment,$emp_id);
            echo $data;
        }
    }
    
    /*method for showing all Absconded/terminated employees list*/
    public function cancelAbscondingTermination(){
        $cancelRequest = '';
        if($this->request->is('post')){
            $r = json_encode($this->request->data('cancelAbsconding'));
            $r = ltrim($r,'"[');
            $r = rtrim($r,']"');
//            $data = $this->request->data('cancelAbsconding');
            $cancelRequest = $this->ExitResignation->cancelRaisedAbscondedTerminatedRequest($r);
//            $this->set(compact('cancelRequest'));
        }
        $data = $this->ExitResignation->getAbscondingDeatils();
        if(!empty($data)){
        $modified_data = $this->fetchLocationBusinessDetails($data);
        }
        $this->set(compact('modified_data','cancelRequest'));
    }
    
    /* method for getting deatils about location and business based on passed array of indivisuals*/
    public function fetchLocationBusinessDetails($arr){
        if(!empty($arr)){
            foreach ($arr as $k=>$v):
                if(!empty($v['business_id'] && $v['company_id'])){
                    $arr[$k]['business_id'] = $this->ExitResignation->getBusiness($v['business_id'],
                            $v['company_id']);
                }
                if(!empty($v['c_location_id'] && $v['company_id'])){
                    $arr[$k]['c_location_id'] = $this->ExitResignation->getLocation($v['c_location_id'],
                            $v['company_id']);
                }
//                if(!empty($v['status']) && $v['status'] == 1){
//                    $arr[$k]['status'] = 'Pending with HR Manager';
//                }
                if(!empty($v['company_id'])){
                    $arr[$k]['company_id'] = $this->ExitResignation->getCompany($v['company_id']);
                }
                if(!empty($v['department_id']) && $v['company_id']){
                    $arr[$k]['department_id'] = $this->ExitResignation->getDepartment($v['department_id'],
                            $v['company_id']);
                }
                if(!empty($v['unit_id']) && $v['company_id']){
                    $arr[$k]['unit_id'] = $this->ExitResignation->getUnit($v['unit_id'],
                            $v['company_id']);
                }
                if(!empty($v['grade_id']) && $v['company_id']){
                    $arr[$k]['grade_id'] = $this->ExitResignation->getGrade($v['grade_id'], $v['company_id']);
                }
            endforeach;
            return $arr;
        }
    }
    
    /*method for cancelling absconded/terminated raised request*/
    public function cancelRaisedAbscondingTerminationRequest(){
        $this->autoRender = false;
        $r = json_encode($this->request->data('cancelAbsconding'));
        $r = ltrim($r,'"[');
        $r = rtrim($r,']"');
        $data = $this->request->data('cancelAbsconding');
        $cancelRequest = $this->ExitResignation->cancelRaisedAbscondedTerminatedRequest($r);
        $this->set(compact('cancelRequest'));
    }
    
    /* method for viewing all applied discussion to HR approved by supervisor*/
    public function viewDiscussion(){
        $user = $this->Auth->user();
        $emp_id = $user['emp_id'];
        $id = $user['id'];
        $allRoles = $this->ExitResignation->getAllRoles();
        $band = $this->ExitResignation->getBand();
        $logged_user_roles = $this->ExitResignation->getRoleId($id);
        $role = $logged_user_roles[0]['role_id'];
        $employeeDetails = $this->ExitResignation->getEmployeeDetails($id);
        $data = '';
//        $employee_discuss_data = '';
        switch ($role){
            case 3: //code for supervisor
                $arr = $this->ExitResignation->getAllAppliedDiscussion($emp_id);
                $data = $this->fetchLocationBusinessDetails($arr);
                break;
            case 4: //code for reviewer
                $get_data = $this->ExitResignation->getAllAppliedDiscussionForReviewer($emp_id);
                $data = $this->fetchLocationBusinessDetails($get_data);
                break;
            case 6: //code for HR Manager
                $discussionDetails = $this->ExitResignation->getListOfDiscussion($employeeDetails['department_id']);
                $data = $this->fetchLocationBusinessDetails($discussionDetails);
                break;
        }
        
        $this->set(compact('data'));
//        echo '<pre>';
//        var_dump($data);
//        echo '</pre>';
    }
    
    /* method for viewing all applied discussion to HR approved by supervisor*/
    public function viewResignation(){
        $user = $this->Auth->user();
        $emp_id = $user['emp_id'];
        $id = $user['id'];
        $allRoles = $this->ExitResignation->getAllRoles();
        $band = $this->ExitResignation->getBand();
        $logged_user_roles = $this->ExitResignation->getRoleId($id);
        $role = $logged_user_roles[0]['role_id'];
        $employeeDetails = $this->ExitResignation->getEmployeeDetails($id);
        $data = '';
//        $employee_discuss_data = '';
        switch ($role){
            case 3:
                $arr = $this->ExitResignation->getAllAppliedResignation($emp_id);
                $data = $this->fetchLocationBusinessDetails($arr);
                break;
            case 4:
                $resignationDetails = $this->ExitResignation->getAllResignationToReviewer($emp_id);
                $data = $this->fetchLocationBusinessDetails($resignationDetails);
                break;
            case 6:
                $resignationDetails = $this->ExitResignation->getListOfResignation($employeeDetails['department_id']);
                $data = $this->fetchLocationBusinessDetails($resignationDetails);
                break;
        }
        
        $this->set(compact('data','role'));
//        
//        echo '<pre>';
//        var_dump($data);
//        echo '</pre>';
    }
}