<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;  

class LeaveTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
                ->notEmpty('fromdate')
                
            ->notEmpty('todate')
            
            ->notEmpty('shift_id')
             
            ;

        return $validator;
    }
    
    function saveLeaveRequest($data){
        
            $empid = strtolower(trim($data['empid']));
            $from_date = $data['fromdate'];
            $todate = $data['todate'];
            $leave_type= $data['leave_type'];
            //$weekoff= implode(',',$data['weekoff']);
            $company_id = $data['company_id'];
            $ip = $_SERVER['REMOTE_ADDR'];
            
            
            $conn = ConnectionManager::get('default');
            
            $startTime = strtotime($from_date);
            $endTime = strtotime($todate);

            /* check if roster already exists */
            /*$q = "SELECT * FROM user_roster WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) ='$empid' AND company_id ='$company_id'";*/
					
			/*$q = "SELECT SUM(credit)-SUM(debit)  as leave_bal FROM `leave_balance` WHERE 
				 company_id = '$company_id' AND leave_type = '$leave_type' AND emp_id = '$empid' 
				 AND addedon BETWEEN '$from_date' AND '$todate'";*/
				 
		$q = "call amsApplyLeave('$from_date','$todate','$leave_type','$company_id','$empid','$empid','$ip')";			

            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
			
			 /*$leave_bal = $res[0]['leave_bal'];
			
			
            
           
            
            if($leave_bal > 0){
				
				
				  
							
			echo $q = "SELECT COUNT(*) as leave_Apply_count 
					FROM `leave` WHERE 
					fromdate >= '$from_date' AND todate <= '$todate' AND leave_type ='$leave_type' AND company_id ='$company_id' AND empid = '$empid' ";
							
					$stmt = $conn->execute($q);
					$res = $stmt->fetchAll('assoc');
					
					$leave_Apply_count = $res[0]['leave_Apply_count'];
				
			if($leave_Apply_count == 0)	{
				
              $q_log = "INSERT INTO `leave` (company_id,leave_type,fromdate,todate,no_of_days ,empid,requestedon,ip)
                             values ('$company_id','$leave_type','$from_date','$todate','0','$empid',NOW(),'$ip')";
              $log_res = $conn->execute($q_log);
              
               return  $log_res;
			   
              if($log_res){
                    $this->Flash->error(__('Leave request added successfully !.'));    
              }
              else{
                  
                //$this->Flash->error(__('Unable to add Roster.'));  
                  
              }
			  
			}
			else{
				
				 return  2;
				
				//$this->Flash->error(__('Leave already exists.')); 
				
			}
              
            }
			else{
				
				//$this->Flash->error(__('Leave balance Empty.'));  
			}
           
            */
            
           /* // Loop between timestamps, 24 hours at a time
            for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
              $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
            
            $stmt = $conn->execute('insert into user_roster (company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip) VALUES("'.$company_id.'","'.$empid.'","'.$thisDate.'","'.$thisDate.'","'.$shift_id.'","'.$weekoff.'",NOW(),"'.$ip.'")');
            
            }
            */
            return  $res;
    }
    
    function viewLeave($from_date,$todate,$empid,$company_id){
        
        $q = "CALL amsViewLeave('$from_date','$todate','$company_id','$empid');";
       $conn = ConnectionManager::get('default');
      /*echo  $q = "SELECT a.*,b.shift_name FROM user_roster as a inner join shift_master as b on a.shift_id = b.id WHERE a.fromdate >= '$from_date' AND a.todate <= '$todate'"
                    . " AND lower(a.empid) ='$empid' AND a.company_id ='$company_id'";
            
     // 
	  
	  
	 $q = " SELECT a.*,b.name FROM `leave` AS a
	INNER JOIN `leave_type_master` AS b ON a.leave_type = b.id
        	
	WHERE a.company_id='$company_id' AND a.empid = '$empid'";*/
      $stmt = $conn->execute($q);
      $res = $stmt->fetchAll('assoc');
            
                         
           
      return $res;
        
    }
    
    function getLeaveType($companyID){
        
        
            $conn = ConnectionManager::get('default');
           $q = "SELECT * FROM leave_type_master where company_id ='$companyID'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
		
	function getLeaveBalance($companyID,$empid){
        
        
            $conn = ConnectionManager::get('default');
			
		

			/* $q = "SELECT b.name ,IFNULL(SUM(a.credit)-SUM(a.debit), 0)  AS INleave_bal FROM `leave_balance`  AS a
			INNER JOIN `leave_type_master` AS b  ON b.id = a.leave_type
			WHERE a.company_id ='$companyID' AND 
			LOWER(a.emp_id) = '$empid'
			AND a.addedon BETWEEN CONCAT(YEAR(NOW()),'-01-01') AND NOW()
			GROUP BY a.leave_type";*/
			
			

             $q = "call amsLeaveBalance('','','$companyID','$empid')";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	
	function getPayableData($fromdate,$todate,$empid,$companyID){
        
        
            $conn = ConnectionManager::get('default');
			
            $q = "call amsLeaveReportPaybledata('$fromdate','$todate','$companyID','$empid')";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	
	function getLeaveRequest($fromdate,$todate,$empid,$companyID,$supvervisor){
        
        
            $conn = ConnectionManager::get('default');
			
            $q = "call amsLeaveRequest('$fromdate','$todate','$companyID','$empid','$supvervisor')";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	
	function SaveLeaveAction($leave_id,$status,$supvervisor){
        
        
            $conn = ConnectionManager::get('default');
			
			$i = 0;
            foreach($leave_id as $lid)	{
            
			 $Leave_status = $status[$i];
			 
			 if($Leave_status){
			 $q = "update `leave` set approvedBy ='$supvervisor',status ='$Leave_status' , approvedon = NOW() where id = '$lid'";
			 $stmt = $conn->execute($q);
			 }
			
			$i ++;
			}
            
            
                        
        return $stmt;
        
    }
	
	
	function getcompoffrequest($fromdate,$todate,$empid,$companyID,$supvervisor){
        
        
            $conn = ConnectionManager::get('default');
			
            $q = "call amsCompoffRequest('$fromdate','$todate','$companyID','$empid','$supvervisor')";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	
	function SaveCompoffAction( $company_id,$emp_id,$leave_id,$status,$supvervisor,$ip){
        
        
            $conn = ConnectionManager::get('default');
		
			$i = 0;
			
			
			
            foreach($leave_id as $lid)	{
            
			 $compoff_status = $status[$i];
			 $empid = $emp_id[$i];
			 
			 if($compoff_status){
				 
				$q = "call amsApproveCompoffRequest('$empid','$company_id','$supvervisor','$compoff_status','$lid','$ip')";
				$stmt = $conn->execute($q);
				$res = $stmt->fetchAll('assoc');
				$stmt->closeCursor();
				
			
			 
			 }
			
			
			$i ++;
			}
            
            
                        
        return $res;
        
    }
	
	
	function getleavesummary($fromdate,$todate,$companyID,$empid){
        
        
            $conn = ConnectionManager::get('default');
			
            $q = "call amsLeaveSummary('$fromdate','$todate','$companyID','$empid')";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	
	
    
}

