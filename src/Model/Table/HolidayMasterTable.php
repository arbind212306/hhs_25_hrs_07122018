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

class HolidayMasterTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('year')
             ->add('hdate', [
                        'unique' => [
                            'rule' => ['validateUnique', ['scope' => 'company_id']],
                            'provider' => 'table',
                            'message' => 'This holiday is already exists'  
                        ]
                    ]);
             
            ;

        return $validator;
    }
    
    function saveHolidays($data){
        
     
        
            $empid = strtolower(trim($data['empid']));
            $year = $data['year'];
            $location = $data['location'];
            $holiday = $data['hdate'];
            $reason = $data['reason'];
            $ip = $data['ip'];
            $company_id = $data['company_id'];
            
            $conn = ConnectionManager::get('default');
            
        
            // Loop between timestamps, 24 hours at a time
            
            $i= 0;
            foreach ($holiday as $hdate ) {
                
                $hdesc = $reason[$i];
                /* check if roster already exists */
            $q = "SELECT * FROM holiday_master WHERE hdate = '$hdate' and company_id = '$company_id'";
            
                        
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            $thisDate = date( 'Y-m-d', $i );
            
            $stmt = $conn->execute('insert into holiday_master (company_id,year,location ,hdate,reason,status,addedon,ip) VALUES("'.$company_id.'","'.$year.'","'.$location.'","'.$hdate.'","'.$hdesc.'","1",NOW(),"'. $ip.'")');
            
            $i++;
            }
            
            return $stmt;
    }
    
   /* function viewHolidays($from_date,$todate,$empid){
        
        
       $conn = ConnectionManager::get('default');
       $q = "SELECT a.*,b.shift_name FROM user_roster as a inner join shift_master as b on a.shift_id = b.id WHERE a.fromdate >= '$from_date' AND a.todate <= '$todate'"
                    . " AND lower(a.empid) ='$empid'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
            //echo "<pre>";
            //print_r( $res );
             //echo "</pre>";
             
             $datar= array();
             foreach($res as $ev){
                 
                $datar[]= array('title'=>$ev['shift_name'],
                                'start'=>$ev['fromdate'],
                                'end'=>$ev['todate']
                    
                                ) ;
                 
             }
            
        return json_encode($datar);
        
    }*/
    
    function getShifts(){
        
        
            $conn = ConnectionManager::get('default');
           $q = "SELECT * FROM shift_master";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
}

