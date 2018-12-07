<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class EmployeesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->hasOne('EmployeeDetails', [
            'foreignKey' => 'employee_id'
        ]);
        $this->hasOne('UserRights', [
            'foreignKey' => 'userid'
        ]);
    }

    function getNewId() {
        return $this->_newId(['id']);
    }

    public function findAuth(\Cake\ORM\Query $query, array $options) {
        $query
                ->find('all')
                ->where(['Employees.status !=' => 0]);
        return $query;
    }

    public function getCompanyIdOfEmployee($employee_id) {
        $eData = $this->find('all', ['fields' => 'company_id'])
                ->where(['id' => $employee_id]);

        if (!empty($eData->first())) {
            return $eData->first()->company_id;
        }else{
            return false;
        }
    }

}
