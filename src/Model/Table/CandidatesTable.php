<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CandidatesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->belongsTo('Departments');
        $this->belongsTo('Designations');
        $this->belongsTo('Business',[
            'foreignKey' => 'business_id'
        ]);
    }

}
