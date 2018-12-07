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

class UserRosterTable extends Table
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
    
    function saveRoster($data){
        
            $empid = strtolower(trim($data['empid']));
            $from_date = $data['fromdate'];
            $todate = $data['todate'];
            $shift_id= $data['shift_id'];
            //$weekoff= implode(',',$data['weekoff']);
            $company_id = $data['company_id'];
            $ip = $_SERVER['REMOTE_ADDR'];
            
            
            $conn = ConnectionManager::get('default');
            
            $startTime = strtotime($from_date);
            $endTime = strtotime($todate);

            /* check if roster already exists */
            $q = "SELECT * FROM user_roster WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) ='$empid' AND company_id ='$company_id'";
            
            
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
            
            
            if(count($res) > 0){
                
              $q_log = "INSERT INTO user_roster_log (company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip)
                        SELECT company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip FROM user_roster  WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) ='$empid' AND company_id ='$company_id'";
              $log_res = $conn->execute($q_log);
              
              
              if($log_res){
              $qd = "DELETE FROM user_roster WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) = '$empid' AND company_id ='$company_id'";
              $deleteres = $conn->execute($qd);  
              }
              else{
                  
                $this->Flash->error(__('Unable to add Roster.'));  
                  
              }
              
            }
           
            
            
            // Loop between timestamps, 24 hours at a time
            for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
              $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
            
			//pr($data['weekoff']);
			
			 if(in_array(date( 'N', $i ),$data['weekoff']))
			 {
				  $weekoff = "1";
			 }
			 else{
				 
				 $weekoff  = "0";
			 }
			 
           
              
               
			   
            $stmt = $conn->execute('insert into user_roster (company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip) VALUES("'.$company_id.'","'.$empid.'","'.$thisDate.'","'.$thisDate.'","'.$shift_id.'","'.$weekoff.'",NOW(),"'.$ip.'")');
            
            }
         
            return $stmt;
    }
    
    function viewRoster($from_date,$todate,$empid,$company_id){
        
        
       $conn = ConnectionManager::get('default');
      /*echo  $q = "SELECT a.*,b.shift_name FROM user_roster as a inner join shift_master as b on a.shift_id = b.id WHERE a.fromdate >= '$from_date' AND a.todate <= '$todate'"
                    . " AND lower(a.empid) ='$empid' AND a.company_id ='$company_id'";
        
      
      
      
	  
	  
	  $q = "SELECT a.*,b.shift_name FROM user_roster AS a 
	INNER JOIN shift_master AS b ON a.shift_id = b.id
	WHERE a.fromdate >= fromdate AND a.todate <= todate 
	AND LOWER(a.empid) ='$empid' AND a.company_id ='$company_id'	";  */  
	
	$q = "CALL amsViewRoster('$from_date','$todate','$company_id','$empid');";
      $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                         
             $datar= array();
             foreach($res as $ev){
				 
				 if($ev['shift_name']=='H') 
				 { $color =  "#cece0b";}
				 else  if($ev['shift_name']=='WO') 
				 { $color = "#8a6d3b";}
			     else
				 {
					$color = '#257e4a'; 
				 }
                 
                $datar[]= array('title'=>$ev['shift_name'],
                                'start'=>$ev['fromdate'],
                                'end'=>$ev['todate'],
								'color'=>  $color
                    
                                ) ;
                  
             }
            
        return json_encode($datar);
        
    }
    
    function getShifts($cid){
        
        
            $conn = ConnectionManager::get('default');
           $q = "SELECT * FROM shift_master where company_id ='$cid'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
	
	

        
   function getRosterList($reqestdata){
        
        
     $conn = ConnectionManager::get('default');
	 
	 $input = array();
	
	 parse_str($reqestdata['fdata'], $input);
	 
	 
	$fromdate = $input['fromdate'];
	$todate   = $input['todate'];
	$cid      = $input['company_id'];
	$supid      = strtolower($input['empid']);
	
	$emparray      = $input['emp'];
	
	 
	 if(count($emparray) > 0 && !empty($emparray)){
		
		
		     foreach($emparray as $emp )
			 {
				
				 
			   $empID = strtolower($emp);
				
	           $q1 = "CALL amsviewTeamRoster('$fromdate','$todate','','$empID','')";
			 
			   $stmt1 = $conn->execute($q1);
			   $rosterlist[] = $stmt1->fetchAll('assoc')[0];
			   $stmt1->closeCursor();
			   
			 }
		
		 
	}else{
	 
	       $q2 = " select * from  employees where 
			emp_id in(SELECT LOWER(emp_id) AS emp_id FROM `employees` WHERE id 
			IN (SELECT employee_id FROM `employee_details` WHERE  LOWER(supervisor_emp_id) = '$supid'))";
 
			
			$stmt2 = $conn->execute($q2);
			$emplist = $stmt2->fetchAll('assoc');
			$stmt2->closeCursor();
			
			 
		
			foreach($emplist as $emp )
			{
	 
	         $empID = strtolower($emp['emp_id']);
	         $q = "CALL amsviewTeamRoster('$fromdate','$todate','','$empID','')";
			 
			
			 $stmt = $conn->execute($q);
			 $rosterlist[] = $stmt->fetchAll('assoc')[0];
			 $stmt->closeCursor();
			 
			 
			}
	}			
								 
             $data= array();
			 $rdata= array();
             foreach($rosterlist as $key => $value){
				 
				
				$k =1;
				foreach($value as $key => $val){
					
				
				if($key == 'Name' || $key == 'EmployeeID'){
					
					$rdata[$key]=$val;
					
				}
				else{
					$rdata['RS'.$k]=$val;
					
					 $k++; 
				}
				
				
				
			 }
                $data[] = $rdata ;
				
				

                
             }
			
			   
			   $coln = array_keys(($rosterlist[0]));
			   $i =1;
			   foreach( $coln as $colnm){
		
									
									
					if($colnm=='Name' || $colnm=='EmployeeID'){
			         $col[] = array('label'=>$colnm,
				                   'name'=> $colnm,
								   'index'=> $colnm,
								   'key'=> true,
								    'align'=>'center',
								   'width'=>150 /*,
								   'editable'=>true,*/
								
								   
				                    );	
									
					 }
					else{
						
						   $col[] = array('label'=>$colnm,
				                   'name'=> "RS".$i,
								   'index'=>$colnm,
								   'key'=> true,
								   'align'=>'center',
								   'width'=>150 /*,
								   'editable'=>true,
								   'edittype'=> "select",
								   'cellEdit'=>true,
								   'editoptions'=> array('value'=> $shitlist)
								   */
				                    );	
									
									$i ++;

					}
				 					
			 }
			
			 
			$datar = array('data'=>$data,
			               'columnNames'=> $col );
		
	
        return json_encode($datar,true);
        
    }
	
	
	
	    function saveteamroster1($data){
	
        
            $conn = ConnectionManager::get('default');     
              

		  $rdata = json_decode($data['rsdata']);
		  $company_id = $data['company_id'];
			  
            foreach($rdata as $r){
				
				 $empid = strtolower($r->empid);
				 $shift_id = $r->shift;
				 $thisDate = $r->rdate;
				
				  echo $q = "SELECT * FROM user_roster WHERE fromdate = '$r->rdate' AND lower(empid) ='$r->empid' AND company_id ='$company_id'";
            
            
					$stmt = $conn->execute($q);
					$res = $stmt->fetchAll('assoc');
					
            
            
					if(count($res) > 0){
						
					   
                       $stmt = $conn->execute('update  user_roster set shift_id ="'.$shift_id.'" where company_id ="'.$company_id.'" AND lower(empid) = "'.$empid.'" AND fromdate="'.$thisDate.'"');
					
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
						
						
						$stmt = $conn->execute('insert into user_roster (company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip) VALUES("'.$company_id.'","'.$empid.'","'.$thisDate.'","'.$thisDate.'","'.$shift_id.'","'.$weekoff.'",NOW(),"'.$ip.'")');
					
						
						
					}
		   }
		   
		   return $stmt;
	
		}
		
		   function getEmnpList($supID,$cmpID){
			   
			   
			$conn = ConnectionManager::get('default');
			$q = "CALL amsGetEmplist('$supID','$cmpID')";
			 
			
			 $stmt = $conn->execute($q);
			 $res = $stmt->fetchAll('assoc');
			 
			 
			 
			   return $res;
		   }
		   
		   
		    function saveTeamRoster($data){
        
            $supID = strtolower(trim($data['empid']));
            $from_date = $data['fromdate'];
            $todate = $data['todate'];
            $shift_id= $data['shift'];
            //$weekoff= implode(',',$data['weekoff']);
            $company_id = $data['company_id'];
            $ip = $_SERVER['REMOTE_ADDR'];
			
			 $emplist = $data['emp'];
            
            
            $conn = ConnectionManager::get('default');
            
            $startTime = strtotime($from_date);
            $endTime = strtotime($todate);
			
			
			foreach($emplist as $employee){
				
				$empid = $employee;
				

            /* check if roster already exists */
            $q = "SELECT * FROM user_roster WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) ='$empid' AND company_id ='$company_id'";
            
            
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
            
            
            if(count($res) > 0){
                
             /* $q_log = "INSERT INTO user_roster_log (company_id,empid,fromdate,todate,shift_id,week_off,addedon,ip)
                        SELECT company_id,empid,fromdate,todate,shift_id,week_off,addedby,addedon,ip FROM user_roster  WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) ='$empid' AND company_id ='$company_id'";
              $log_res = $conn->execute($q_log);
              */
              
             /* if($log_res){*/
			  if(1){
              $qd = "DELETE FROM user_roster WHERE fromdate >= '$from_date' AND todate <= '$todate'"
                    . " AND lower(empid) = '$empid' AND company_id ='$company_id'";
              $deleteres = $conn->execute($qd);  
              }
              else{
                  
                $this->Flash->error(__('Unable to add Roster.'));  
                  
              }
              
            }
			
			
			
           
            
            
            // Loop between timestamps, 24 hours at a time
            for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
              $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
            
			//pr($data['weekoff']);
			
			 if(in_array(date( 'N', $i ),$data['weekoff']))
			 {
				  $weekoff = "1";
			 }
			 else{
				 
				 $weekoff  = "0";
			 }
			 
           
              
               
			   
            $stmt = $conn->execute('insert into user_roster (company_id,empid,fromdate,todate,shift_id,week_off,addedby,addedon,ip) VALUES("'.$company_id.'","'.$empid.'","'.$thisDate.'","'.$thisDate.'","'.$shift_id.'","'.$weekoff.'","'.$supID.'",NOW(),"'.$ip.'")');
			
			
            
            }
			
			
			
			}
         
            return $stmt;
    }
		
		
}

