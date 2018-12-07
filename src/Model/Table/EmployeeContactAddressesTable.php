<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class EmployeeContactAddressesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
    }

}
