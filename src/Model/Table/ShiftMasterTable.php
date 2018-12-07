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

class ShiftMasterTable extends Table
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
                            'rule' => ['validateUnique', ['scope' => 'company_id']],
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
    
    
    function getShiftCategory($company_id){
        
        
            $conn = ConnectionManager::get('default');
           $q = "SELECT * FROM shift_category where status = '1' and company_id ='$company_id'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
    function getShiftRegularization($company_id){
        
        
            $conn = ConnectionManager::get('default');
           $q = "SELECT * FROM shift_regularization where status = '1' and company_id ='$company_id'";
            $stmt = $conn->execute($q);
            $res = $stmt->fetchAll('assoc');
            
                        
        return $res;
        
    }
    
    
    
}

