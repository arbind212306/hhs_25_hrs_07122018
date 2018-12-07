<?php

namespace App\Controller;

class DemoController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('demo');
    }

    public function organisation() {
        
    }

}
