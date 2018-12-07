<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;  

class ExitResignationTable extends Table {
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    public function initialize(array $config){
            parent::initialize($config);
            $this->setTable('exit_resignation');
            $this->setPrimaryKey('id');
//            $this->belongsTo('employees', [
//            'foreignKey' => 'emp_id',
//            'joinType' => 'INNER'
//        ]);
//            $this->belongsTo('employees');
//            $this->setForeignKey('emp_id');
    }
    
    /* method to get employees total number of working days  */
    public function getNumberOfemployeesWorkingDays($id=''){
        $this->setTable('employee_details');
        $query = $this->find()->select(['datediff' => 'DATEDIFF(CURDATE(), doj)'])->where(['employee_id' => $id]);
        foreach ($query as $employees):
           $noOfWorkdays =  $employees->toArray();
        endforeach;
        return $noOfWorkdays['datediff'];
    }

    /*method to get exit reasons */
    public function getExitReason(){
        $status = '1';
        $connection = ConnectionManager::get('default');
        $sql = "SELECT DISTINCT id AS id, reason AS reason FROM exit_reason WHERE status='".$status."' ";
        $query = $connection->execute($sql)->fetchAll('assoc');
        $r = [];
        foreach ($query as $value) {
            $r[] = $value;
        }
        return $r;
    }

    /*method to get contact details and notice period details*/
    public function getNoticeDetails($id=''){
        $this->setTable('employee_emergency_contacts');
        $query = $this->find()->select(['notice_period'=>'n.notice_period', 'mobile'=>'mobile1'])
                ->join([
                    'n' => [
                        'table' => 'employee_notice_period',
                        'type' => 'INNER',
                        'conditions' => 'n.employee_id=ExitResignation.employee_id',
                    ]
                ])
                ->where(['ExitResignation.employee_id' => $id]);
        $data = [];     
        foreach ($query as $r) {
                   $data = $r->toArray();
               } 
        if(!empty($data)){
            $q = $data;
        }else {
            $q= '';
        } 
        // pr($q);exit;       
        return $q;   

    }
    
    /* method to check wheather the request for the same has been generated or not.
     * if generated then wheather it has been approved by the supervisor.
     */
    public function checkStausForSameDisscussRequest($emp_id){
        $this->setTable('exit_disscussed');
        $query = $this->find()->select(['emp_id' => 'emp_id', 'appraiser_status' => 'appraiser_status'])
                ->where(['emp_id' => $emp_id, 'appraiser_status' => '0']);
        $data = [];
        foreach ($query as $row){
            $data[] = $row->toArray();
        }
        return $data;
    }
    
    /*
     * method to insert data for disscussion with supervisor
     */
    public function exit_discussion($emp_id, $discussed_text){
        $current_date = date('Y-m-d H:i:s');
        $conn = ConnectionManager::get('default');
        $sql = "INSERT INTO exit_disscussed(emp_id,employee_disscuss_text,created_date,modified_date,"
                . "appraiser_status,status) VALUES('".$emp_id."','".$discussed_text."','".$current_date."',"
                . "'".$current_date."','0','1')";
        if($conn->execute($sql)){
            $msg = "Your request has been generated. Manager will get in touch with you soon for further discussion";
        }
        else{
            $msg = "We are getting some problem, please try again !!";
        }
        return $msg;
    }
    
    /* method to check wheather resignation the request for the same has been generated or not.
     * if generated then wheather it has been approved by the supervisor.
     */
    public function checkStausForSameResignationRequest($emp_id){
        $query = $this->find()->select(['emp_id' => 'emp_id', 'appraiser_status' => 'appraiser_status'])
                ->where(['emp_id' => $emp_id, 'appraiser_status' => '1']);
        $data = [];
        foreach ($query as $row){
            $data[] = $row->toArray();
        }
        return $data;
    }
    
    /*
     * method for generating resignation request
     */    
    public function exit_resignation($arr){
        $conn = ConnectionManager::get('default');
        $sql = "INSERT INTO exit_resignation(emp_id,resignation_text,serve_notice_period,exit_reason,"
                . "reason_for_last_working_day,separation_date,created_date,modified_date,appraiser_status,"
                . "status,hrstatus,reviewer_status) VALUES('".$arr['emp_id']."','".$arr['resignation_text']."',"
                . "'".$arr['serve_notice_period']."','".$arr['exit_reason']."',"
                . "'".$arr['reason_for_last_working_day']."','".$arr['separation_date']."',"
                . "'".$arr['created_date']."','".$arr['modified_date']."','".$arr['appraiser_status']."',"
                . "'".$arr['status']."','".$arr['hrstatus']."','".$arr['reviewer_status']."')";
        if($conn->execute($sql)){
            $msg = 'Resignation request has been submitted successfully.';
        }
        else{
            $msg = 'Please try again !!';
        }
        return $msg;
    }
    
    /* method for getting the role id of indivisual user from user_rights table */
    public function getRoleId($user_id){
        $this->setTable('user_rights');
        $query = $this->find()->select(['role_id' => 'roleid', 'company_id' => 'company_id'])
                 ->where(['userid' => $user_id, 'status' => 1]);
        
        $getRole = [];
        foreach ($query as $role){
            $getRole[] = $role->toArray();
        }
        return $getRole;
    }
    
    /* method for getting all roles */
    public function getAllRoles(){
        $this->setTable('roles');
        $query = $this->find()->select(['id' => 'id', 'title' => 'title', 'company_id' => 'company_id'])
                ->where(['status' => 1]);
        $allRoles = [];
        foreach ($query as $roles){
            $allRoles[] = $roles->toArray();
        }
        return $allRoles;
    }
    
    /*
     * method to get all request applied for disscussion for indivisuals
     */
    public function getAllAppliedDiscussion($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT DISTINCT d.id as id, d.emp_id as emp_id, d.appraiser_status as appraiser_status,
                concat(u.first_name,' ',u.last_name) as name, u.company_id as company_id,
                ud.unit_id as unit_id, ud.department_id as department_id, ud.grade_id as grade_id, 
                ud.c_location_id as c_location_id, ud.supervisor_emp_id as supervisor_emp_id
                FROM exit_disscussed as d 
                INNER JOIN employees as u on d.emp_id=u.emp_id
                INNER JOIN employee_details as ud on ud.employee_id=u.id
                WHERE d.appraiser_status='0' AND d.status='1'";
        if(!empty($emp_id)){
            $sql .= " AND  ud.supervisor_emp_id = '".$emp_id."'";
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $conn->execute($sql);
        $res = $stmt->fetchAll('assoc');
        return $res;
    }
    
    /*
     * method to get all resignation request
     */
    public function getAllAppliedResignation($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT DISTINCT e.id as id, e.emp_id as emp_id, e.appraiser_status as appraiser_status,
            e.hrstatus as hrstatus, e.reviewer_status as reviewer_status,
            u.id as user_id, concat(first_name,' ',u.last_name) as name,u.company_id as company_id,
            ud.unit_id as unit_id, ud.department_id as department_id, ud.grade_id as grade_id,
            ud.c_location_id as c_location_id,ud.supervisor_emp_id as supervisor_emp_id 
            FROM exit_resignation as e 
            INNER JOIN employees as u on e.emp_id = u.emp_id
            INNER JOIN employee_details as ud on u.id=ud.employee_id  
            WHERE e.appraiser_status='1' AND e.status='1'";
        if(!empty($emp_id)){
            $sql .= " AND ud.supervisor_emp_id = '".$emp_id."'";
        }
        $sql .= " GROUP BY emp_id ORDER BY e.id DESC";
        $stmt = $conn->execute($sql);
        $res = $stmt->fetchAll('assoc');
        return $res;
    }
    
    /*
     * method for getting department of indivisuals based on company id and department id
     */
    public function getDepartment($department_id, $company_id){
        $row = '';
         $this->setTable('departments');
         $query = $this->find()->select(['title']);
         if(!empty($department_id) && !empty($company_id)){
             $row = $query->where(['company_id' => $company_id, 'id' => $department_id, 'status' => 1]);
         }
         return $this->returnData($row);
    }
    
    /*
     * method for getting unit of indivisuals based on company id and unit id 
     */
    public function getUnit($unit_id, $company_id){
        $row = '';
        $this->setTable('units');
         $query = $this->find()->select(['title']);
         if(!empty($unit_id) && !empty($company_id)){
             $row = $query->where(['company_id' => $company_id, 'id' => $unit_id, 'status' => 1]);
         }
         return $this->returnData($row);
    }
    
     /*
     * method for getting business of indivisuals based on company id and unit id 
     */
    public function getBusiness($grade_id, $company_id){
        $row = '';
        $this->setTable('business');
         $query = $this->find()->select(['title']);
         if(!empty($grade_id) && !empty($company_id)){
             $row = $query->where(['company_id' => $company_id, 'id' => $grade_id, 'status' => 1]);
         }
         return $this->returnData($row);
    }
    
    /*
     * method for getting grade of indivisuals based on company id and unit id 
     */
    public function getGrade($grade_id, $company_id){
        $row = '';
        $this->setTable('grades');
         $query = $this->find()->select(['title']);
         if(!empty($grade_id) && !empty($company_id)){
             $row = $query->where(['company_id' => $company_id, 'id' => $grade_id, 'status' => 1]);
         }
         return $this->returnData($row);
    }
    
    /*
     * method for getting grade of indivisuals based on company id and unit id 
     */
    public function getLocation($location_id, $company_id){
        $row = '';
        $this->setTable('c_locations');
         $query = $this->find()->select(['title']);
         if(!empty($location_id) && !empty($company_id)){
             $row = $query->where(['company_id' => $company_id, 'id' => $location_id, 'status' => 1]);
         }
         return $this->returnData($row);
    }
    
    /*
     * function to return data of indivisuals based on passed parameters in order to reduce the code 
     */
    public function returnData($row){
        if(!empty($row)){
            foreach ($row as $r){
             $b = $r->toArray();
            }
         }
         
         if(!empty($b)){
             $b = $b['title'];
         }
         else{
             $b = '';
         }
        return $b;
    }
    
    /*
     * method to find the details of disccusion for indivisuals based on id
     */
    public function getDisscussedDetails($id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT d.emp_id AS emp_id, d.employee_disscuss_text AS disscuss_text, d.created_date AS created_date,"
                . "d.appraiser_status AS appraiser_status, d.status AS status, "
                . "CONCAT(u.first_name,' ',u.last_name) AS name, u.email AS email "
                . "FROM exit_disscussed AS d "
                . "INNER JOIN employees AS u ON d.emp_id=u.emp_id "
                . "WHERE d.id=$id AND d.status='1' AND d.appraiser_status=0";
        $query = $conn->execute($sql)->fetchAll('assoc');
        return $query;
    }
    
    /*
     * method for getting discussion details for between supervisor and employee to reviewer
     */
    public function getDiscusseddetailsToReviewer($id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT d.emp_id AS emp_id, d.employee_disscuss_text AS disscuss_text, d.created_date AS created_date,"
                . "d.appraiser_status AS appraiser_status, d.status AS status,"
                . "d.appraiser_disscussed_text AS appraiser_disscussed_text, "
                . "CONCAT(u.first_name,' ',u.last_name) AS name, u.email AS email "
                . "FROM exit_disscussed AS d "
                . "INNER JOIN employees AS u ON d.emp_id=u.emp_id "
                . "WHERE d.id=$id AND d.status='1' AND d.appraiser_status=1";
        $query = $conn->execute($sql)->fetchAll('assoc');
        return $query;
    }
    
    /*
     * method for inserting appraiser disscussion with employee
     */
    
    public function insertAppraiserDisscussion($emp_id,$disscuss_text,$id){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_disscussed SET appraiser_disscussed_text='".$disscuss_text."', "
                . "appraiser_status='1' WHERE id='".$id."' "
                . "AND emp_id='".$emp_id."' AND status='1'";
        if($conn->execute($sql)){
            $msg =  'Discussion Request has been completed';
        }else{
            $msg = 'Please try again';
        }
        return $msg;
    }
    
    /*
     * method for inserting reviewer comment/text against employee and supervisor
     */
    public function insertReviewerDisscussion($emp_id,$disscuss_text,$id){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_disscussed SET reviewer_discussed_text='".$disscuss_text."', "
                . "appraiser_status='2' WHERE id='".$id."' "
                . "AND emp_id='".$emp_id."' AND status='1'";
        if($conn->execute($sql)){
            $msg =  'Discussion Request has been completed';
        }else{
            $msg = 'Please try again';
        }
        return $msg;
    }
    
    /*
     * method for inserting HR Manager discuss text/comments
     */
    public function insertHrDisscussion($emp_id,$disscuss_text,$id){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_disscussed SET hr_discussed_text='".$disscuss_text."', "
                . "appraiser_status='3' WHERE id='".$id."' "
                . "AND emp_id='".$emp_id."' AND status='1'";
        if($conn->execute($sql)){
            $msg =  'Discussion Request has been completed';
        }else{
            $msg = 'Please try again';
        }
        return $msg;
    }
    
    /*
     * method for getting resignation details of employee based on id
     */
    public function getResignationDetails($id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT r.id as id,e.id as employee_id,r.emp_id as emp_id, r.resignation_text as resignation_text, "
                . "r.reason_for_last_working_day as reason_for_last_working_day, r.created_date as created_date,"
                . "r.appraiser_status as appraiser_status,r.exit_reason as exit_reason, "
                . "r.serve_notice_period as serve_notice_period, r.waiver_notice_pay as waiver_notice_pay,"
                . "r.request_for_last_working_day as request_for_last_working_day, "
                . "r.separation_date as separation_date, CONCAT(e.first_name,' ',e.last_name) as name,"
                . "e.email as email "
                . " FROM exit_resignation r "
                . " INNER JOIN employees e ON e.emp_id=r.emp_id "
                . " WHERE r.id='".$id."'";
        if($query = $conn->execute($sql)){
            $r = $query->fetchAll('assoc');
            $data = [];
            if(!empty($r)){
                foreach($r as $v){
                    $data[] = $v;
                }
            }
            return $data[0];
        }
    }
    
    /*method for inserting approved resign request of employee by supervisor*/
    public function insertAppraiserApprovedResignation($id,$emp_id,$appraiser_status,
                    $hold_salary,$waiver_notice_pay,$appraiser_comments,$separation_date,$serve_notice_period){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_resignation SET appraiser_status='".$appraiser_status."',hold_salary='".$hold_salary."',"
                . "waiver_notice_pay='".$waiver_notice_pay."',appraiser_comments='".$appraiser_comments."',"
                . "separation_date='".$separation_date."',serve_notice_period='".$serve_notice_period."'"
                . "WHERE id='".$id."' AND emp_id='".$emp_id."'";
        if($conn->execute($sql)){
            if($appraiser_status == 2){
                $msg = 'Resignation request is approved';
            }else {
                $msg = 'Resignation request is retained';
            }
        }else{
            $msg = 'sorry please try after some time';
        }
        return $msg;
    }
    
    /*
     * method for updating applied employee resignation by reviewer
     */
    public function reviewerResignationComment($id,$emp_id,$reviewer_status,$hold_salary,
                    $waiver_notice_pay,$reviewer_comments,$separation_date,$serve_notice_period){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_resignation SET reviewer_status='".$reviewer_status."', hold_salary='".$hold_salary."',"
                . "waiver_notice_pay='".$waiver_notice_pay."',reviwer_comment='".$reviewer_comments."',"
                . "separation_date='".$separation_date."',serve_notice_period='".$serve_notice_period."' "
                . " WHERE id='".$id."' AND emp_id='".$emp_id."'";
        if($conn->execute($sql)){
            if($reviewer_status == 2){
                $msg = 'Resignation request is approved';
            }else {
                $msg = 'Resignation request is retained';
            }
        }else{
            $msg = 'sorry please try after some time';
        }
        return $msg;
        
    }
    
    /*method for updating applied employee resignation 
     * by HR Manager
     */
    public function insertHrManagerApprovedResignation($id,$emp_id,$hr_status,
                    $hold_salary,$waiver_notice_pay,$hr_comments,$separation_date,$serve_notice_period){
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_resignation SET hrstatus='".$hr_status."',hold_salary='".$hold_salary."',"
                . "waiver_notice_pay='".$waiver_notice_pay."',hr_comment='".$hr_comments."',"
                . "separation_date='".$separation_date."',serve_notice_period='".$serve_notice_period."'"
                . "WHERE id='".$id."' AND emp_id='".$emp_id."'";
        if($conn->execute($sql)){
            if($hr_status == 2){
                $msg = 'Resignation request is approved';
            }else {
                $msg = 'Resignation request is retained';
            }
        }else{
            $msg = 'sorry please try after some time';
        }
        return $msg;
    }

    /*method to get all employee*/
//    public function getAllEmployee($emp_id,$id){
//        $this->setTable('employees');
//        $query = $this->find()->select(['id'=>'ExitResignation.id', 'emp_id'=>'emp_id', 
//            'name'=>"CONCAT(first_name,' ',last_name)", 'company_id'=>'company_id',
//             'unit_id'=>'ed.unit_id', 'department_id'=>'ed.department_id', 'grade_id'=>'ed.grade_id', 
//            'c_location_id'=>'ed.c_location_id'])
//            ->join([
//                'ed' => [
//                    'table' => 'employee_details',
//                    'type' => 'INNER',
//                    'conditions' => 'ed.employee_id=ExitResignation.id',
//                ]
//            ])
//            ->where(['ed.supervisor_emp_id' => $emp_id,'ed.appraiser_id'=>$id]);
//            $r = [];
//            foreach ($query as $value) {
//                $r[] = $value->toArray();
//            }
//            if($r){
//               $result = $r;
//            }else{
//                $result = '';
//            }
//            return $result;
//    }
    
    /*method for getting all employees for particular supervisor
     * i.e., list of all employees working under supervisor 
     */
    public function getAllEmployeeForParticularSupervisior($emp_id,$user_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT e.id AS id, e.emp_id AS emp_id, CONCAT(first_name,' ',last_name) AS name, 
            ed.unit_id AS unit_id,  ed.c_location_id AS c_location_id, ed.grade_id AS grade_id, 
            ed.department_id AS department_id, r.status AS status, e.company_id AS company_id,
            r.appraiser_status AS appraiser_status
            FROM employees AS e
            LEFT JOIN exit_resignation AS r ON e.emp_id=r.emp_id
            LEFT JOIN employee_details AS ed ON ed.employee_id=e.id
            WHERE e.status=1 ";
        if(!empty($emp_id) && !empty($user_id)){
            $sql .= " AND ed.supervisor_emp_id='".$emp_id."' AND ed.appraiser_id='".$user_id."'";
        }
        $r = [];
        if($result = $conn->execute($sql)){
            $data = $result->fetchAll('assoc');
            foreach ($data as $v){
                $r[] = $v;
            }
        }
        return $r;
    }

    /* method for getting few employee details based on id from employee table*/
    public function getFewEmployeeDetails($id){
        $this->setTable('employees');
        $query = $this->find()->select(['name'=>"CONCAT(first_name,' ',last_name)",'emp_id'=>'emp_id',
            'email'=>'email'])->where(['id'=> $id]);
        $r = [];    
            foreach ($query as $value) {
                $r[] = $value->toArray();
            }
           return $r[0];
    }

    /*method to initiate resignation*/
    public function initiateResignation($emp_id,$exit_reason,$resignation_date,
            $separation_date,$current_date,$hold_salary,$waiver_notice_pay,$get_comments,$serve_notice_period){
        $status = 1;
        $appraiser_status = 5;
        $conn = ConnectionManager::get('default');
        $sql = "INSERT INTO exit_resignation(emp_id,serve_notice_period,exit_reason,request_for_last_working_day,"
                . "separation_date,created_date,modified_date,appraiser_status,"
                . "hold_salary,waiver_notice_pay,appraiser_comments,status) VALUES('".$emp_id."',"
                . "'".$serve_notice_period."','".$exit_reason."','".$resignation_date."',"
                . "'".$separation_date."','".$current_date."','".$current_date."','".$appraiser_status."',"
                . "'".$hold_salary."','".$waiver_notice_pay."','".$get_comments."','".$status."')";

        if($result = $conn->execute($sql)){
            $msg = 'Resignation request has been initiated.';
        }else{
            $msg = 'Sorry please try again.';
        }
       return $msg; 
    }
    
    /*method for getting Absconding/Termination Reason*/
    public function getAbscondingTerminationReason(){
        $this->setTable('absconding_termination_reason');
        $query = $this->find()->select(['id'=>'id','terminate_reason'=>'terminate_reason','status'=>'status'])->where('status="1"');
        $r = [];
        foreach ($query as $val){
            $r[] = $val->toArray();
        }
        return $r;
    }
    
    /*method to get all absconding/terminated employess*/
    public function getAbsconding(){
        $this->setTable('exit_absconding_termination');
        $query = $this->find()->select(['emp_id'=>'emp_id']);
        $r = [];
        foreach ($query as $val){
            $r[] = $val->toArray();
        }
        return $r;
    }
    
    /*method for raising absconding/termination request and inserting details to database*/
    public function raiseTerminationrequest($emp_id,$process,$terminate_reason,
                    $separation_date,$remark,$status){
        $current_date = date('Y-m-d H:i:s');
        $this->setTable('exit_absconding_termination');
        $data = [
            'emp_id' => $emp_id,
            'process' => $process,
            'separation_date' => $separation_date,
            'created_date' => $current_date,
            'modified_date' => $current_date,
            'reason_for_termination' => $terminate_reason,
            'remarks' => $remark,
            'hr_status' => $status,
            'status' => $status
        ];
        $entity = $this->newEntity($data);
       if($this->save($entity)){
           if($process == 0){
               $val = 'Terminating';
           }else{
               $val = 'Absconding';
           }
           $connection = ConnectionManager::get('default');
           $sql = "UPDATE employees SET status=0 WHERE emp_id = '".$emp_id."'";
           $query = $connection->execute($sql);
           $msg = '"'.$val.'" request has been initiated.';
       }else{
           $msg = 'Sorry please try again';
       }
       return $msg;
    }
    
    /*method for getting absconded/terminated details*/
    public function getAbscondingDeatils(){
        $this->setTable('exit_absconding_termination');
        $query = $this->find()->select(['id'=>'ExitResignation.id','emp_id'=>'ExitResignation.emp_id',
        'status'=>'ExitResignation.status','name'=>"CONCAT(e.first_name,' ',e.last_name)",
            'company_id'=>'e.company_id', 'doj'=>'ed.doj', 'business_id'=>'ed.business_id',
            'c_location_id'=>'ed.c_location_id'])
        ->join([
            'e' => [
                'table' => 'employees',
                'type' => 'INNER',
                'conditions' =>'e.emp_id=ExitResignation.emp_id',
            ]
        ])
        ->join([
            'ed' => [
                'table' => 'employee_details',
                'type' => 'INNER',
                'conditions' => 'e.id=ed.employee_id',
            ]
        ])
        ->where(['ExitResignation.status' => 1]);
        $r = [];
        foreach($query as $v):
            $r[] = $v->toArray();
        endforeach;
        if(!empty($r)){
            return $r;
        }else{
            return '';
        }
    }
    
    /*method for getting companies based on id*/
    public function getCompany($comapany_id){
        $this->setTable('companies');
        $query = $this->find()->select(['name'=>'name'])->where(['id'=>$comapany_id,'status'=>1]);
        $p = [];
        foreach ($query as $v):
            $p[] = $v->toArray();
        endforeach;
       return $p[0]['name'];
    }
    
    /*method for getting all employees for absconding/termination who are not applied for resignation*/
    public function getAllEmployeesNotAppliedResignation($id,$emp_id){
        $this->setTable('employees');
        $query = $this->find()->select(['id'=>'ExitResignation.id', 'emp_id'=>'ExitResignation.emp_id',
            'company_id'=>'ExitResignation.company_id',
            'name'=>"CONCAT(ExitResignation.first_name,' ',ExitResignation.last_name)", 'unit_id'=>'ed.unit_id',
            'department_id'=>'ed.department_id', 'grade_id'=>'ed.grade_id', 'c_location_id'=>'ed.c_location_id'])
                ->join([
                    'ed' => [
                        'table' => 'employee_details',
                        'type' => 'INNER',
                        'conditions' => 'ExitResignation.id=ed.employee_id',
                    ]
                ])
                ->where(['ExitResignation.status'=>1,'ed.supervisor_emp_id'=>"{$emp_id}",'ed.appraiser_id'=>"{$id}"]);
//                ->order(['ExitResignation.id'=>'desc']);
        $p = [];
        foreach ($query as $r){
            $p[] = $r->toArray();
        }
        if(!empty($p)){
            return $p;
        }
    }
    
    /*method for cancelling all the Absconded/Terminated raised request based on emp_id*/
    public function cancelRaisedAbscondedTerminatedRequest($arr){
        $connection = ConnectionManager::get('default');
        $sql = 'UPDATE exit_absconding_termination SET status="0" WHERE emp_id IN("'.$arr.'")';
        $msg = '';
        if($connection->execute($sql)){
            $query = 'UPDATE employees SET status="1" WHERE emp_id IN("'.$arr.'")';
            if($connection->execute($query)){
                $msg = 'Absconding/Termination request has been cancelled ';
            }
        }else{
            $msg = 'Sorry try again';
        }
        return $msg;
    }
    
    /*method for getting band */
    public function getBand($id='',$company_id=''){
        $this->setTable('bands');
        $query = $this->find()->select(['id'=>'id','title'=>'title','level'=>'level']);
        if(!empty($id) && !empty($company_id)){
            $row = $query->where(['id'=>$id,'company_id'=>$company_id,'status'=>1]);
        }else{
            $row = $query->where(['status'=>1]);
        }
        $r = [];
        foreach ($row as $v){
            $r[] = $v->toArray();
        }
        return $r;
    }
    
    /*method for getting employee details based on id*/
    public function getEmployeeDetails($id){
        $this->setTable('employees');
        $query = $this->find()->select(['id'=>'ExitResignation.id', 'emp_id'=>'emp_id', 
            'name'=>"CONCAT(first_name,' ',last_name)", 'company_id'=>'company_id',
             'unit_id'=>'ed.unit_id', 'department_id'=>'ed.department_id', 'grade_id'=>'ed.grade_id', 
            'c_location_id'=>'ed.c_location_id'])
            ->join([
                'ed' => [
                    'table' => 'employee_details',
                    'type' => 'INNER',
                    'conditions' => 'ed.employee_id=ExitResignation.id',
                ]
            ])
            ->where(['ExitResignation.id'=>$id,'status'=>1]);
        $r = [];
        foreach ($query as $v){
            $r[] = $v->toArray();
        }
        return $r[0];
    }
    
    /*method for getting all applied discussion approved by supervisor */
    public function getListOfDiscussion($depart_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT DISTINCT d.id as id, d.emp_id as emp_id, d.appraiser_status as appraiser_status,
                concat(u.first_name,' ',u.last_name) as name, u.company_id as company_id,
                ud.unit_id as unit_id, ud.department_id as department_id, ud.grade_id as grade_id, 
                ud.c_location_id as c_location_id, ud.supervisor_emp_id as supervisor_emp_id,
                ud.department_id as department_id
                FROM exit_disscussed as d 
                INNER JOIN employees as u on d.emp_id=u.emp_id
                INNER JOIN employee_details as ud on ud.employee_id=u.id
                WHERE d.appraiser_status=2 AND u.status=1 AND d.status='1'";
        if(!empty($depart_id)){
            $sql .= " AND  ud.department_id = '".$depart_id."'";
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $conn->execute($sql);
        $res = $stmt->fetchAll('assoc');
        return $res;
    }
    
    /*method for getting appraiser comment/text discussed with employee*/
    public function getDiscusseddetailsToHR($id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT d.emp_id AS emp_id, d.employee_disscuss_text AS disscuss_text, d.created_date AS created_date,"
                . "d.appraiser_status AS appraiser_status, d.status AS status, "
                . "d.appraiser_disscussed_text AS appraiser_disscussed_text, "
                . "reviewer_discussed_text AS reviewer_discussed_text, "
                . "CONCAT(u.first_name,' ',u.last_name) AS name, u.email AS email "
                . "FROM exit_disscussed AS d "
                . "INNER JOIN employees AS u ON d.emp_id=u.emp_id "
                . "WHERE d.id=$id AND d.status='1' AND d.appraiser_status=2";
        $query = $conn->execute($sql)->fetchAll('assoc');
        return $query;
    }
    
    /*method for getting list of applied resignation by employee approved by supervisor
     * to HR Manager
     */
    public function getListOfResignation($depart_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT DISTINCT r.id as id, r.emp_id as emp_id, r.appraiser_status as appraiser_status,
                r.hrstatus as hrstatus, r.reviewer_status as reviewer_status,
                concat(u.first_name,' ',u.last_name) as name, u.company_id as company_id,
                ud.unit_id as unit_id, ud.department_id as department_id, ud.grade_id as grade_id, 
                ud.c_location_id as c_location_id, ud.supervisor_emp_id as supervisor_emp_id,
                ud.department_id as department_id
                FROM exit_resignation as r 
                INNER JOIN employees as u on r.emp_id=u.emp_id
                INNER JOIN employee_details as ud on ud.employee_id=u.id
                WHERE r.appraiser_status=2 OR r.appraiser_status=5 OR r.appraiser_status=3 AND u.status=1 
                AND r.status='1' AND r.reviewer_status=2 OR r.reviewer_status=3";
        if(!empty($depart_id)){
            $sql .= " AND  ud.department_id = '".$depart_id."'";
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $conn->execute($sql);
        $res = $stmt->fetchAll('assoc');
        return $res;
    }
    
    /*method for getting appraiser text/comment for applied employee resignation 
     * approved by appraiser
     * showing details to HR Manager
     */
    public function getAppraiserCommentAgainstResignation($id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT r.id as id,e.id as employee_id,r.emp_id as emp_id, r.resignation_text as resignation_text, "
                . "r.reason_for_last_working_day as reason_for_last_working_day, r.created_date as created_date,"
                . "r.appraiser_status as appraiser_status,r.exit_reason as exit_reason, "
                . "r.serve_notice_period as serve_notice_period, r.waiver_notice_pay as waiver_notice_pay,"
                . "r.request_for_last_working_day as request_for_last_working_day,"
                . "r.appraiser_comments as appraiser_comments, r.reviwer_comment as reviwer_comment, "
                . "r.separation_date as separation_date, CONCAT(e.first_name,' ',e.last_name) as name,"
                . "e.email as email,ed.appraiser_id as appraiser_id "
                . " FROM exit_resignation r "
                . " INNER JOIN employees e ON e.emp_id=r.emp_id "
                . " INNER JOIN employee_details ed ON e.id=ed.employee_id "
                . " WHERE r.id='".$id."' AND r.status='1'";
        $sql .= " ORDER BY e.id DESC";
        $data = [];
        if($stmt = $conn->execute($sql)){
        $res = $stmt->fetchAll('assoc');
        if(!empty($res)){
            foreach ($res as $v){
                $data[] = $v;
            }
        }
        return $res[0];
        }
    }
    
    /*method for getting all list of discussion request applied
     * this is visible to reviewer
     */
    public function getAllAppliedDiscussionForReviewer($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT d.id AS id, d.emp_id AS emp_id, d.appraiser_status AS appraiser_status, 
            CONCAT(e.first_name,' ',e.last_name) AS name,e.company_id AS company_id, ed.unit_id AS unit_id, 
            ed.department_id AS department_id, ed.grade_id AS grade_id,ed.c_location_id AS c_location_id, 
            ed.supervisor_emp_id AS supervisor_emp_id
            FROM exit_disscussed AS d
            INNER JOIN employees AS e ON e.emp_id=d.emp_id
            INNER JOIN employee_details AS ed ON ed.employee_id=e.id
            WHERE supervisor_emp_id = '".$emp_id."' OR supervisor_emp_id =
            (SELECT em.emp_id AS emp_id FROM employees em INNER JOIN employee_details emd ON em.id=emd.employee_id 
            WHERE supervisor_emp_id = '".$emp_id."') "
                . " AND d.appraiser_status=1 AND d.status='1' AND e.status=1 ";
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data;
    }
    
    /*
     * method for getting all list of applied resignation request
     * this is visible to reviewer
     */
    public function getAllResignationToReviewer($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT r.id AS id, r.emp_id AS emp_id, r.appraiser_status AS appraiser_status, 
            r.reviewer_status AS reviewer_status, r.hrstatus AS hrstatus,
            CONCAT(e.first_name,' ',e.last_name) AS name, 
            e.company_id AS company_id, ed.unit_id AS unit_id, ed.c_location_id AS c_location_id, 
            ed.department_id AS department_id, ed.grade_id AS grade_id, ed.supervisor_emp_id AS supervisor_emp_id
            FROM exit_resignation AS r
            INNER JOIN employees AS e ON e.emp_id=r.emp_id
            INNER JOIN employee_details AS ed ON e.id=ed.employee_id
            WHERE supervisor_emp_id = '".$emp_id."' OR supervisor_emp_id =
            (SELECT em.emp_id AS emp_id FROM employees em INNER JOIN employee_details emd ON em.id=emd.employee_id 
            WHERE supervisor_emp_id = '".$emp_id."') "
                . " AND r.status='1' AND r.appraiser_status=2 OR r.appraiser_status=3 OR r.appraiser_status=5 AND e.status=1";
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data;
    }
    
    /*method for getting all absconding/termination request for reviewer*/
    public function getAllAbscondingTerminationToReviewer($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT a.id AS id, a.emp_id AS emp_id, a.hr_status AS hr_status, 
            CONCAT(e.first_name,' ',e.last_name) AS name, e.company_id AS company_id, ed.unit_id AS unit_id, 
            ed.c_location_id AS c_location_id, ed.department_id AS department_id, ed.grade_id AS grade_id, 
            ed.supervisor_emp_id AS supervisor_emp_id
            FROM exit_absconding_termination AS a
            INNER JOIN employees AS e ON a.emp_id=e.emp_id
            INNER JOIN employee_details AS ed ON ed.employee_id=e.id
            WHERE supervisor_emp_id = (SELECT em.emp_id AS emp_id FROM employees em INNER JOIN employee_details emd ON              em.id=emd.employee_id  WHERE supervisor_emp_id = '".$emp_id."') OR supervisor_emp_id = '".$emp_id."'
            AND a.hr_status=1 AND a.status='1'";
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data;
    }
    
    /*method for getting absconding/Termination Details of indivisual based on id*/
    public function getAbscondingTerminationDetails($id){
        $status = 1;
         $conn = ConnectionManager::get('default');
         $sql = " SELECT a.id AS id, a.emp_id AS emp_id, a.process AS process, "
                 . "a.serve_notice_period AS serve_notice_period,"
                 . "a.last_working_date AS last_working_date, a.separation_date AS separation_date,"
                 . "a.created_date AS created_date,a.reason_for_termination AS reason_for_termination,"
                 . " a.remarks AS remarks, a.hr_status AS hr_status,"
                 . "CONCAT(e.first_name,' ',e.last_name) AS name, e.email AS email "
                 . " FROM exit_absconding_termination AS a "
                 . " INNER JOIN employees AS e ON a.emp_id=e.emp_id "
                 . " WHERE a.status='".$status."' AND e.status='".$status."' ";
         if(!empty($id)){
             $sql .= " AND a.id='".$id."'";
         }
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data[0];
    }
    
    /*
     *  method for getting appraiser name by selecting emp_id from employee_detail table
     *  based on provieded employee emp_id
     */
    public function getAppraiserName($emp_id){
        $conn = ConnectionManager::get('default');
        $sql = "SELECT CONCAT(e.first_name,' ',e.last_name) AS name, e.email AS email, e.emp_id AS emp_id
                FROM employees AS e
                WHERE emp_id = (SELECT ed.supervisor_emp_id 
                FROM employee_details AS ed 
                INNER JOIN employees AS e2 ON ed.employee_id=e2.id 
                WHERE e2.emp_id = '".$emp_id."' ) AND e.status=1";
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data[0];
    }
    
    /*
     * method for getting all absconding/termination request to reviewer
     */
    public function approveAbscondingByReviewer($id,$exit_reason,$reviewer_comment){
        $status = 2;
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_absconding_termination SET reviewer_comment='".$reviewer_comment."',"
                . "reason_for_termination='".$exit_reason."',hr_status='".$status."' "
                . " WHERE id='".$id."' AND status='1'";
        $msg = '';
        if($conn->execute($sql)){
            $msg = 'Absconding/Termination request completed successfully';
        }else{
            $msg = 'Please try again';
        }
        return $msg;
    }
    
    /*
     * method for getting all absconding/termination request to HR Manager
     */
    public function getAllTerminationRequestToHR($department){
       $conn = ConnectionManager::get('default');
       $sql = "SELECT a.id AS id, a.emp_id as emp_id, a.hr_status as hr_status, e.company_id AS company_id, "
               . "CONCAT(e.first_name,' ',e.last_name) AS name, ed.unit_id AS unit_id, "
               . "ed.c_location_id AS c_location_id, ed.grade_id AS grade_id, ed.department_id AS department_id "
               . " FROM exit_absconding_termination AS a "
               . " INNER JOIN employees AS e ON a.emp_id=e.emp_id "
               . " INNER JOIN employee_details AS ed ON e.id=ed.employee_id"
               . " WHERE hr_status=2 AND a.status='1' AND e.status=1";
       if(!empty($department)){
           $sql .= " AND ed.department_id = '".$department."'";
       }
        $sql .= " ORDER BY id DESC";
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data;
    }
    
    /*method for getting absconding/termination details to HR*/
    public function getAbscondingTerminationDetailsToHR($id){
        $hr_status = 2;
        $status = 1;
         $conn = ConnectionManager::get('default');
         $sql = " SELECT a.id AS id, a.emp_id AS emp_id, a.process AS process, "
                 . "a.serve_notice_period AS serve_notice_period,"
                 . "a.last_working_date AS last_working_date, a.separation_date AS separation_date,"
                 . "a.created_date AS created_date,a.reason_for_termination AS reason_for_termination,"
                 . " a.remarks AS remarks, a.hr_status AS hr_status, a.reviewer_comment as reviewer_comment,"
                 . "CONCAT(e.first_name,' ',e.last_name) AS name, e.email AS email, "
                 . " ed.supervisor_emp_id AS supervisor_emp_id "
                 . " FROM exit_absconding_termination AS a "
                 . " INNER JOIN employees AS e ON a.emp_id=e.emp_id "
                 . " INNER JOIN employee_details AS ed ON e.id=ed.employee_id "
                 . " WHERE a.hr_status='".$hr_status."' AND e.status='".$status."' AND a.status='".$status."'";
         if(!empty($id)){
             $sql .= " AND a.id='".$id."'";
         }
        $data = [];
        if($stm = $conn->execute($sql)){
            $result =  $stm->fetchAll('assoc');
            if(!empty($result)){
                foreach ($result as $v){
                    $data[] = $v;
                }
            }
        }
        return $data[0];
    }
    
    /* method for getting  employee details based on emp_id from employee table*/
    public function getEmployeeBasedOnEmpid($emp_id){
        $this->setTable('employees');
        $query = $this->find()->select(['name'=>"CONCAT(first_name,' ',last_name)",'emp_id'=>'emp_id',
            'email'=>'email'])->where(['emp_id'=> $emp_id]);
        $r = [];    
            foreach ($query as $value) {
                $r[] = $value->toArray();
            }
           return $r[0];
    }
    
    /*method for approving absconding/terminating request by HR Manger*/
    public function approveAbscondingByHR($id,$exit_reason,$hr_comment,$emp_id){
        $status = 3;
        $conn = ConnectionManager::get('default');
        $sql = "UPDATE exit_absconding_termination SET hr_comment='".$hr_comment."',"
                . "reason_for_termination='".$exit_reason."',hr_status='".$status."' "
                . " WHERE id='".$id."' AND status='1'";
        $msg = '';
        if($conn->execute($sql)){
            $sql1 = "UPDATE employees SET status='0' WHERE emp_id='".$emp_id."'";
            if($conn->execute($sql1)){
                $msg = 'Absconding/Termination request completed successfully';
            }
        }else{
            $msg = 'Please try again';
        }
        return $msg;
    }
}
