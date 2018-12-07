<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Company Model
 *
 * @property \App\Model\Table\AttendanceCategoryTable|\Cake\ORM\Association\HasMany $AttendanceCategory
 * @property \App\Model\Table\AttendanceTypeTable|\Cake\ORM\Association\HasMany $AttendanceType
 * @property \App\Model\Table\BandsTable|\Cake\ORM\Association\HasMany $Bands
 * @property \App\Model\Table\BusinessTable|\Cake\ORM\Association\HasMany $Business
 * @property \App\Model\Table\CLocationsTable|\Cake\ORM\Association\HasMany $CLocations
 * @property \App\Model\Table\CompanyConfigTable|\Cake\ORM\Association\HasMany $CompanyConfig
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\HasMany $Departments
 * @property \App\Model\Table\DesignationsTable|\Cake\ORM\Association\HasMany $Designations
 * @property \App\Model\Table\EmpAttendanceTypesTable|\Cake\ORM\Association\HasMany $EmpAttendanceTypes
 * @property \App\Model\Table\EntitlementAccumulationMasterTable|\Cake\ORM\Association\HasMany $EntitlementAccumulationMaster
 * @property \App\Model\Table\GradesTable|\Cake\ORM\Association\HasMany $Grades
 * @property \App\Model\Table\HolidayMasterTable|\Cake\ORM\Association\HasMany $HolidayMaster
 * @property \App\Model\Table\LeaveTable|\Cake\ORM\Association\HasMany $Leave
 * @property \App\Model\Table\LeaveBalanceTable|\Cake\ORM\Association\HasMany $LeaveBalance
 * @property \App\Model\Table\LeaveReasonTable|\Cake\ORM\Association\HasMany $LeaveReason
 * @property \App\Model\Table\LeaveTypeMasterTable|\Cake\ORM\Association\HasMany $LeaveTypeMaster
 * @property \App\Model\Table\RegularizationReasonTable|\Cake\ORM\Association\HasMany $RegularizationReason
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\HasMany $Roles
 * @property \App\Model\Table\RosterWeekoffTable|\Cake\ORM\Association\HasMany $RosterWeekoff
 * @property \App\Model\Table\ShiftCategoryTable|\Cake\ORM\Association\HasMany $ShiftCategory
 * @property \App\Model\Table\ShiftMasterTable|\Cake\ORM\Association\HasMany $ShiftMaster
 * @property \App\Model\Table\ShiftRegularizationTable|\Cake\ORM\Association\HasMany $ShiftRegularization
 * @property \App\Model\Table\SubDepartmentsTable|\Cake\ORM\Association\HasMany $SubDepartments
 * @property \App\Model\Table\UnitsTable|\Cake\ORM\Association\HasMany $Units
 * @property \App\Model\Table\UserAttendanceTable|\Cake\ORM\Association\HasMany $UserAttendance
 * @property \App\Model\Table\UserRightsTable|\Cake\ORM\Association\HasMany $UserRights
 * @property \App\Model\Table\UserRosterTable|\Cake\ORM\Association\HasMany $UserRoster
 * @property \App\Model\Table\UserRosterLogTable|\Cake\ORM\Association\HasMany $UserRosterLog
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 * @property \App\Model\Table\ZonesTable|\Cake\ORM\Association\HasMany $Zones
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompanyTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AttendanceCategory', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AttendanceType', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Bands', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Business', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CLocations', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyConfig', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Departments', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Designations', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('EmpAttendanceTypes', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('EntitlementAccumulationMaster', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Grades', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('HolidayMaster', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Leave', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('LeaveBalance', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('LeaveReason', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('LeaveTypeMaster', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('RegularizationReason', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Roles', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('RosterWeekoff', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ShiftCategory', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ShiftMaster', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ShiftRegularization', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('SubDepartments', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Units', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UserAttendance', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UserRights', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UserRoster', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UserRosterLog', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Zones', [
            'foreignKey' => 'company_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
