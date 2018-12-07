<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->hasOne('UserDetails');
        $this->hasOne('UserRights',[
            'foreignKey' => 'userid'
        ]);
       
    }

    function getUser($username) {

        $username = strtolower($username);

        $conn = ConnectionManager::get('default');
        $q = "SELECT b.roleid , a.id,concat(a.first_name,' ',a.last_name) as name,a.username,a.email,a.gender,a.emp_id,a.company_id  FROM `employees`  as a  "
                . "inner join user_rights as b on a.id = b.userid"
                . " where  a.username='$username' ";
        $stmt = $conn->execute($q);
        $res = $stmt->fetchAll('assoc');


        return $res;
    }

}
