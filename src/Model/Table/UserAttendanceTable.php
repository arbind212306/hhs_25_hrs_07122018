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


class UserAttendanceTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
                ->notEmpty('shift_name')
                ->add('shift_name', [
                'unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'This shift name is already exists'
                ]
                ])
            ->notEmpty('start_time')
                
            ->notEmpty('end_time')
            ->notEmpty('night_shift')    
            ;

        return $validator;
    }
    
    function markAttendance($data){
        
       
        
      
        
        
            $empid = strtolower(trim($data['empid']));
            $att_date = $data['att_date'];
            
            $shift_id= $data['shift_id'];
            
            $first_half = $data['first_half'];
            $second_half = $data['second_half'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $company_id =  $data['company_id'];
          
            $conn = ConnectionManager::get('default');
            
            $i = 0;
            foreach($att_date AS $adate){
                
                $shiftid    = $shift_id[$i];
                $firsthalf  = $first_half[$i];
                $secondhalf = $second_half[$i];
				
				
				 $stmt = $conn->execute('call amsSelfAttendance("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'","'.$empid.'","'.$ip.'")');
				 $res = $stmt->fetchAll('assoc');
				 $stmt->closeCursor();

                /*
				
				$q = "SELECT * FROM user_attendance WHERE att_date = '$adate' AND shift_id = '$shiftid'"
                     . " AND lower(empid) ='$empid'";

                $stmt = $conn->execute($q);
                $res = $stmt->fetchAll('assoc');


                 if(count($res) == 0 && $firsthalf !=0  && $secondhalf !=0){
                  
				  
				  $stmt = $conn->execute('insert into user_attendance (empid,company_id,att_date,shift_id,first_half_attendance_type,second_half_attendance_type,addedon,addedby,ip) '
                          . 'VALUES("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'",NOW(),"'.$empid.'","'.$ip.'")');
                 }*/
                 /*else{

                     $this->Flash->error(__('Issue with marked for date .')); 

                 }*/
            
              $i++;
             }  
           
            
            return $res;
    }
    
    function viewAttendance($fromdate,$todate,$empid,$companyID){
        
        
       $conn = ConnectionManager::get('default');
       
       /*$q = "SELECT a.*,b.shift_name FROM user_roster as a inner join shift_master as b on a.shift_id = b.id WHERE a.fromdate >= '$from_date' AND a.todate <= '$todate'"
                    . " AND lower(a.empid) ='$empid'";
					
					
					$q = "SELECT a.*,c.shift_name,b.shift_id ,
	CASE 
	WHEN b.shift_id IS NOT NULL THEN 'Marked' ELSE 'Pending' END AS AttendanceStatus
	FROM `user_roster` AS a 
	LEFT JOIN user_attendance AS b ON a.fromdate = b.att_date AND a.empid = b.empid
	#LEFT JOIN user_attendance AS b ON a.empid = b.empid
	INNER JOIN `shift_master` AS c ON a.shift_id = c.id 
	WHERE a.company_id = '$companyID' AND a.empid= '$empid' ";*/
       
          $q = "CALL amsViewAttendance('$fromdate','$todate','$companyID','$empid');";
       
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
            //echo "<pre>";
            //print_r( $res );
             //echo "</pre>";
             
             $datar= array();
             foreach($res as $ev){
                 
                 
                 if($ev['AttendanceStatus']=='Marked')
				 {
					 $ff = explode(',',$ev['shift_name']);
					 if(count($ff) > 1){
						$color= "#337ab7"; 
					 }
					 else if(trim($ev['shift_name']) =='Absent'){
						 $color= "#a94442"; 
					 }
					 else if($ev['shift_name'] =='Week Off'){
						 $color= "#8a6d3b"; 
					 }
					  else if($ev['shift_name'] =='Holiday'){
						 $color= "#cece0b"; 
					 } else if($ev['shift_name'] =='Business Travel'){
						 $color= "#333"; 
					 }
					 else if(trim($ev['shift_name']) =='Present'){
						 $color= "#257e4a"; 
					 }
					 else{
						$color= "#605ca8"; 
					 }
					 
                     
				 }
                 else
                     $color= "#dddddd";
                     
                 
                $datar[]= array('title'=>$ev['shift_name'],
                                'start'=>$ev['fromdate'],
                                'end'=>$ev['todate'],
                                                               'color'=>$color
                  
                        
                                ) ;
                 
             }
			 
			 
			
			
			 
			
			 
            
        //return json_encode($datar);
		
		return $datar;
        
    }
    
    
     function pendingAttendance($fromdate,$todate,$empid,$companyID){
        
        
       $conn = ConnectionManager::get('default');
      /* $q = "SELECT a.*,c.shift_name FROM `user_roster` AS a 
            LEFT JOIN user_attendance AS b ON a.fromdate = b.att_date
            INNER JOIN `shift_master` AS c ON a.shift_id = c.id 
            WHERE a.empid= '$empid' AND b.att_date IS NULL AND b.shift_id IS NULL";
			
			

	
	$q = "SELECT a.*,c.shift_name,
	CASE 
	WHEN b.shift_id IS NOT NULL THEN 'Marked' ELSE 'Pending' END AS STATUS
	FROM `user_roster` AS a 
	LEFT JOIN user_attendance AS b ON a.fromdate = b.att_date AND a.empid = b.empid
	INNER JOIN `shift_master` AS c ON a.shift_id = c.id 
	WHERE a.company_id = '$companyID' AND a.empid= '$empid' 
	AND b.att_date IS NULL AND b.shift_id IS NULL
	ORDER BY a.fromdate ASC";*/
       
       $q = "CALL amsPendingAttendance('$fromdate','$todate','$companyID','$empid');";
       
       
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
      
             return $res;
        
    }
    
    function getAttCat($company_id){
        
        
            $conn = ConnectionManager::get('default');
            /*$q = "SELECT * FROM attendance_category where status = '1' and company_id ='$company_id'";*/
			$q = "SELECT * FROM attendance_category where status = '1'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
	
	 function getBMSdata($fromdate,$todate,$empid){
        
        
            $conn = ConnectionManager::get('default');
          /* $q = "SELECT INdate ,MIN(INtime) AS in_time, MAX(INtime) AS out_time,
				TIMESTAMPDIFF(HOUR,MIN(INtime),MAX(INtime)) AS Work_hours_roundoff ,
				ROUND(TIME_TO_SEC(TIMEDIFF( MAX(INtime),MIN(INtime)))/3600 ,2)AS Work_hours , 
				COUNT(INtime) AS COUNT 
				FROM `user_bms_data` WHERE LOWER(Empid) = '$empid' 
				AND INdate BETWEEN '$fromdate' AND '$todate'
				GROUP BY INdate";*/
				
				$q = "CALL amsUserBmsdata('$fromdate','$todate','$empid');";
				

            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
			
			
			  $databms= array();
             foreach($res as $ev){
				 
				 
				  $databms[]= array('title'=>$ev['Work_hours'],
                                'start'=>$ev['INdate'],
                                'end'=>$ev['INdate'],
								
                                'color'=>'#257e4a'
                  
                        
                                ) ;
			 }
            
                        
        return $databms;
        
    }
	
	
	
	 function getAttedanceList($reqestdata){
        
        
     $conn = ConnectionManager::get('default');
	 
	 
	 
	 $input =  $attlist = array();
	 
	 
	
	 parse_str($reqestdata['fdata'], $input);
	 
	
	 
	$emparray = array();
	 
	$fromdate = $input['fromdate'];
	$todate   = $input['todate'];
	$cid      = $input['company_id'];
	$supid      = strtolower($input['empid']);
	
	$emparray      = $input['emp'];
	
	
	
	
	
	/*$shift = $this->getAttCat($cid);
	 
	  $attlist['0'] = 'Please select';
	 foreach( $shift as $sf){
		 
		 $attlist[' '.$sf['id'].' '] = $sf['name'];
	 }
	
    */
	
		$datar = array();
		
	if(count($emparray) > 0 && !empty($emparray)){
		
		
		     foreach($emparray as $emp )
			 {
				
				 
			   $empID = strtolower($emp);
				
	           $q1 = "CALL amsViewTeamAttendance('$fromdate','$todate','','$empID','')";
			 
			   $stmt1 = $conn->execute($q1);
			   $rosterlist[] = $stmt1->fetchAll('assoc')[0];
			   $stmt1->closeCursor();
			   
			 }
		
		 
	}
	else{


			$q2 = " select * from  employees where 
			emp_id in(SELECT LOWER(emp_id) AS emp_id FROM `employees` WHERE id 
			IN (SELECT employee_id FROM `employee_details` WHERE  LOWER(supervisor_emp_id) = '$supid'))";
 
			
			$stmt2 = $conn->execute($q2);
			$emplist = $stmt2->fetchAll('assoc');
			$stmt2->closeCursor();
			
			 
		
			foreach($emplist as $emp )
			{
				
			   $empID = strtolower($emp['emp_id']);
				
	           $q3 = "CALL amsViewTeamAttendance('$fromdate','$todate','','$empID','')";
			 
			   $stmt3 = $conn->execute($q3);
			   $rosterlist[] = $stmt3->fetchAll('assoc')[0];
			   $stmt3->closeCursor();
			}

		}	
								 
             $data= array();
			 
             foreach($rosterlist as $key => $value){
				 
				
				$k = $j=1;
				$rdata= array();
				foreach($value as $key => $val){
					
				
				/*if(strpos($colnm, 'FH') !== false){
					
					
					
					$rdata["FH".$k]=$val;
					
					 $k++;
					
				}
				else if(strpos($colnm, 'SH') !== false)
				{
					
					$rdata["SH".$j]=$val;
					
					 $j++;
				}
				else{
					 $rdata[$key]=$val;
				}*/
				
				$rdata[$key]=$val;
				
				
			 }
                $data[] = $rdata ;
				
				

                
             }
			
			
			   
			   $coln = array_keys(($rosterlist[0]));
			   $i = $ik =1;
			   foreach( $coln as $colnm){
		
		
		
						 $col[] = array('label'=>$colnm,
				                   'name'=> $colnm,
								   'index'=> $colnm,
								   'key'=> true,
								    'align'=>'center',
								   'width'=>150,
								   'editable'=>false,
								
								   
				                    );	
					/*				
									
					if(strpos($colnm, 'FH') !== false){
			        
									
									$col[] = array('label'=>$colnm,
				                   'name'=> 'FH'.$i,
								   'index'=>$colnm,
								   'key'=> true,
								   'align'=>'center',
								   'width'=>150 /*,
								   'editable'=>true,
								   'edittype'=> "select",
								  'cellEdit'=>true,
								   'editoptions'=> array('value'=> $attlist)*/
						/*			   
				                    );	
									
									$i ++;
									
					 }
					 else if(strpos($colnm, 'SH') !== false){
			        
									
									$col[] = array('label'=>$colnm,
				                   'name'=> 'SH'.$ik,
								   'index'=>$colnm,
								   'key'=> true,
								   'align'=>'center',
								   'width'=>150 /*,
								   'editable'=>true ,
								   'edittype'=> "select",
								   'cellEdit'=>true,
								   'editoptions'=> array('value'=> $attlist)*/
								   
				                /*	    );	
									
									$ik ++;
									
					 }
					else{
						
						
						 $col[] = array('label'=>$colnm,
				                   'name'=> $colnm,
								   'index'=> $colnm,
								   'key'=> true,
								    'align'=>'center',
								   'width'=>150,
								   'editable'=>false,
								
								   
				                    );	
						   

					}
					/*/
				 					
			 }
			
			 
			$datar = array('data'=>$data,
			               'columnNames'=> $col );
		
	
        return json_encode($datar,true);
        
    }
	
	
	function setteamattendance1($data){
	
        
          $conn = ConnectionManager::get('default');     
              
		  $rdata = json_decode($data['rsdata']);
		  		  
		  $company_id = $data['company_id'];
		  
		   
            foreach($rdata as $r){
				
				 $empid = strtolower($r->empid);
				 $status = $r->status;
				 $thisDate = $r->rdate;
				 
				 
				 
				 
				 if (strpos($thisDate, 'FH') !== false) {
					 
					$firsthalf =  $status;
					
					$adate = trim(str_replace(array( '(', ')' ,'FH'),'',$thisDate));
					
					
				 }
				 else{

					 $secondhalf =  $status;
					 $adate = trim(str_replace(array( '(', ')' ,'SH'),'',$thisDate));
					 
				 }
				 
				
				$q = "SELECT * FROM user_attendance WHERE att_date = '$adate' AND shift_id = '$shiftid'"
                     . " AND lower(empid) ='$empid'";

                $stmt = $conn->execute($q);
                $res = $stmt->fetchAll('assoc');
				
				
				/* get shift id */
				
				 $q = "SELECT * FROM user_roster WHERE fromdate = '$adate' AND lower(empid) ='$empid'";

                $stmt = $conn->execute($q);
                $sh = $stmt->fetchAll('assoc')[0];

				
				 $shiftid = $sh['shift_id'];

                            
					if(count($res) > 0){
						
					   
                       //$stmt = $conn->execute('update  user_attendance set shift_id ="'.$shift_id.'" where company_id ="'.$company_id.'" AND lower(empid) = "'.$empid.'" AND fromdate="'.$adate.'"');
					
					}
					else{
						
						/*if(in_array(date( 'N', $i ),$data['weekoff']))
						 {
							  $weekoff = "1";
						 }
						 else{
							 
							 $weekoff  = "0";
						 }*/
			              $weekoff  = "0";
						  $ip = $_SERVER['REMOTE_ADDR'];
						
						
						 if(count($res) == 0){
						  $stmt = $conn->execute('insert into user_attendance (empid,company_id,att_date,shift_id,first_half_attendance_type,second_half_attendance_type,addedon,addedby,ip) '
								  . 'VALUES("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'",NOW(),"'.$empid.'","'.$ip.'")');
						 }
						 
					
					}
		   }
		   
		   return $stmt;
	
		}
		
		
		
	function markTeamAttendance1($data){
        
       
        
		 
		
            $empid = strtolower(trim($data['empid']));
            $att_date = $data['att_date'];
            
            $shift_id= $data['shift_id'];
            
            $first_half = $data['first_half'];
            $second_half = $data['second_half'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $company_id =  $data['company_id'];
           
            $conn = ConnectionManager::get('default');
            
            $i = 0;
            foreach($att_date AS $adate){
                
                $shiftid    = $shift_id[$i];
                $firsthalf  = $first_half[$i];
                $secondhalf = $second_half[$i];
				
				
				 $stmt = $conn->execute('call amsSelfAttendance("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'","'.$empid.'","'.$ip.'")');

                /*
				
				$q = "SELECT * FROM user_attendance WHERE att_date = '$adate' AND shift_id = '$shiftid'"
                     . " AND lower(empid) ='$empid'";

                $stmt = $conn->execute($q);
                $res = $stmt->fetchAll('assoc');


                 if(count($res) == 0 && $firsthalf !=0  && $secondhalf !=0){
                  
				  
				  $stmt = $conn->execute('insert into user_attendance (empid,company_id,att_date,shift_id,first_half_attendance_type,second_half_attendance_type,addedon,addedby,ip) '
                          . 'VALUES("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'",NOW(),"'.$empid.'","'.$ip.'")');
                 }*/
                 /*else{

                     $this->Flash->error(__('Issue with marked for date .')); 

                 }*/
            
              $i++;
             }  
           
            
            return $stmt;
    }
	
	
	function markTeamAttendance($data){
        
         
            $supID = strtolower(trim($data['empid']));
            $att_date = $data['att_date'];
            
            $shiftid= $data['shift_id'];
            
            $firsthalf = $data['first_half'];
            $secondhalf = $data['second_half'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $company_id =  $data['company_id'];
			
			
			 if(isset($data['compoff']))
			   $compoff =  $data['compoff'];
		     else
			   $compoff =  '0';
				 
			
			
			$emplist =  $data['emp'];
          
            $conn = ConnectionManager::get('default');
            
           
			
			$from_date = $data['fromdate'];
            $todate = $data['todate'];
			$startTime = strtotime($from_date);
            $endTime = strtotime($todate);
			
			foreach($emplist as $employee){
			
			$empid = $employee;
			
			
			
			 $q = "select * from user_roster where empid = '$empid' and company_id='$company_id' 
			 AND (fromdate BETWEEN '$from_date' AND '$todate') order by fromdate ASC";
			 $stmt = $conn->execute($q);
			 $resqr = $stmt->fetchAll('assoc');
			 
			 
			
			    foreach($resqr as $attAcorRoster){
			
					
				  $adate = $attAcorRoster['fromdate'];
				  $shiftid = $attAcorRoster['shift_id'];
				
				  
				  $q = 'call amsSetTeamAttendance("'.$empid.'","'.$company_id.'","'.$adate.'","'.$shiftid.'","'.$firsthalf.'","'.$secondhalf.'","'.$supID.'","'.$ip.'","'.$compoff.'")';
				  
				 
				  
				
				  $stmt = $conn->execute($q);
				  $res = $stmt->fetchAll('assoc');
				  $stmt->closeCursor();

				
				}
			
			}
			
			
            return $res;
    }
	
	
	function getEmnpList($supID,$cmpID){
			   
			   
			$conn = ConnectionManager::get('default');
			$q = "CALL amsGetEmplist('$supID','$cmpID')";
			 
			
			 $stmt = $conn->execute($q);
			 $res = $stmt->fetchAll('assoc');
			 
			 
			 
			   return $res;
		   }
}

