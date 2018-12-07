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

class LeaveTypeMasterTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
     public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name')
                ->add('name', [
                        'unique' => [
                            'rule' => ['validateUnique', ['scope' => 'company_id']],
                            'provider' => 'table',
                            'message' => 'This category is already exists'  
                        ]
                    ])
            ->notEmpty('status')
            
            ;

        return $validator;
    }
    
     function getLeaveType($id , $company_id){
        
        
            $conn = ConnectionManager::get('default');
            $q = "SELECT * FROM leave_type_master where company_id ='$company_id' and status = '1' ";
                
             if($id)
              $q .= "and id not in($id)";
             
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
     function getNatureCategory($cid){
        
        
            $conn = ConnectionManager::get('default');
            $q = "SELECT * FROM nature_of_employment where status = '1' and company_id ='$cid'";
            
          
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
    function getRoles($cid){
        
        
            $conn = ConnectionManager::get('default');
            $q = "SELECT * FROM roles where status = '1' and company_id ='$cid'";
            
          
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
}

