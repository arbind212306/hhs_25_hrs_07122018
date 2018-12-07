<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReportTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
     public function validationDefault(Validator $validator)
    {
        /*$validator
            ->notEmpty('name')
                 ->add('name', [
                'unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'This category is already exists'
                ]
                ])
            ->notEmpty('status')
            
            ;*/
        
           $validator
                ->notEmpty('name')
                ->add('name', [
                        'unique' => [
                            'rule' => ['validateUnique', ['scope' => 'company_id']],
                            'provider' => 'table',
                            'message' => 'This category is already exists'  
                        ]
                    ]);

        return $validator;
    }
}

