<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\AttendanceCategory[] $attendance_category
 * @property \App\Model\Entity\AttendanceType[] $attendance_type
 * @property \App\Model\Entity\Band[] $bands
 * @property \App\Model\Entity\Busines[] $business
 * @property \App\Model\Entity\CLocation[] $c_locations
 * @property \App\Model\Entity\CompanyConfig[] $company_config
 * @property \App\Model\Entity\Department[] $departments
 * @property \App\Model\Entity\Designation[] $designations
 * @property \App\Model\Entity\EmpAttendanceType[] $emp_attendance_types
 * @property \App\Model\Entity\EntitlementAccumulationMaster[] $entitlement_accumulation_master
 * @property \App\Model\Entity\Grade[] $grades
 * @property \App\Model\Entity\HolidayMaster[] $holiday_master
 * @property \App\Model\Entity\Leave[] $leave
 * @property \App\Model\Entity\LeaveBalance[] $leave_balance
 * @property \App\Model\Entity\LeaveReason[] $leave_reason
 * @property \App\Model\Entity\LeaveTypeMaster[] $leave_type_master
 * @property \App\Model\Entity\RegularizationReason[] $regularization_reason
 * @property \App\Model\Entity\Role[] $roles
 * @property \App\Model\Entity\RosterWeekoff[] $roster_weekoff
 * @property \App\Model\Entity\ShiftCategory[] $shift_category
 * @property \App\Model\Entity\ShiftMaster[] $shift_master
 * @property \App\Model\Entity\ShiftRegularization[] $shift_regularization
 * @property \App\Model\Entity\SubDepartment[] $sub_departments
 * @property \App\Model\Entity\Unit[] $units
 * @property \App\Model\Entity\UserAttendance[] $user_attendance
 * @property \App\Model\Entity\UserRight[] $user_rights
 * @property \App\Model\Entity\UserRoster[] $user_roster
 * @property \App\Model\Entity\UserRosterLog[] $user_roster_log
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Zone[] $zones
 */
class Company extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'attendance_category' => true,
        'attendance_type' => true,
        'bands' => true,
        'business' => true,
        'c_locations' => true,
        'company_config' => true,
        'departments' => true,
        'designations' => true,
        'emp_attendance_types' => true,
        'entitlement_accumulation_master' => true,
        'grades' => true,
        'holiday_master' => true,
        'leave' => true,
        'leave_balance' => true,
        'leave_reason' => true,
        'leave_type_master' => true,
        'regularization_reason' => true,
        'roles' => true,
        'roster_weekoff' => true,
        'shift_category' => true,
        'shift_master' => true,
        'shift_regularization' => true,
        'sub_departments' => true,
        'units' => true,
        'user_attendance' => true,
        'user_rights' => true,
        'user_roster' => true,
        'user_roster_log' => true,
        'users' => true,
        'zones' => true
    ];
}
