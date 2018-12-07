<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class UserDetailsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Departments');
        $this->belongsTo('Designations');
        $this->belongsTo('Units');
        $this->belongsTo('Bands');
        $this->belongsTo('Business',[
            'foreignKey' => 'business_id'
        ]);
    }

}
