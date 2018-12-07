<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// src/Model/Entity/Shift_master.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class AttendanceCategory extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false   
    ];
}
