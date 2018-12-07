<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function login() {
        if (!empty($this->Auth->user())) {
            $this->gotoDashboard();
        }
        $this->viewBuilder()->setLayout('blank');
        if ($this->request->is('post')) {
            $requestData = $this->request->data;


            $user = $this->Auth->identify($requestData);
            if ($user) {
                // Clear old messages
                $this->request->session()->delete('Flash');

                $user['menu'] = $this->setMenu($user);
                $this->Auth->setUser($user);
                $session = $this->request->session();
                $username = $requestData['username'];
                $userdata = $this->Users->getUser($username)[0];
                $session->write('name', $userdata['name']);
                $session->write('empid', $userdata['emp_id']);
                $session->write('company_id', $userdata['company_id']);
                $session->write('role_id', $userdata['roleid']);

                $this->gotoDashboard();
            }
        }
    }

    public function setMenu($user) {
        //$company_id = $user['company_id'];
        // ToDo Roles base menu.
        $userRightsTable = TableRegistry::getTableLocator()->get('UserRights');
        $query0 = $userRightsTable->find('all')
                ->where(['UserRights.userid' => $user['id'], 'UserRights.status' => 1]);
        $allowedMenu = [];
        if (!empty($userRightObj = $query0->first())) {
            $allowedMenu = json_decode($userRightObj['access'], true);
        }
        //pr($allowedMenu);die;
        $menuTable = TableRegistry::getTableLocator()->get('Menus');
        $query = $menuTable->find('threaded')
                ->where(['status' => 1])
                ->order(['morder ASC','NAME ASC']);
        $menu = [];
        foreach ($query as $k1 => $rw) {

            if (!empty($rw) && (!empty($rw->children))) {
                $rw = $rw->toArray();
                //pr($rw);//die;
                foreach ($rw['children'] as $key => $chm) {
                    //var_dump(in_array($chm['id'],$allowedMenu));
                    if (empty($allowedMenu) || (!in_array($chm['id'], $allowedMenu))) {
                        unset($rw['children'][$key]);
                    }
                }
                //pr($rw);die;
                if (empty($rw['children'])) {
                    unset($rw[$k1]);
                }
                if (!empty($rw)) {
                    $menu[] = $rw;
                }
            }else{
                
                                $rw = $rw->toArray();
                 $menu[] = $rw;
                
            }
        }
        //pr($menu);die;
        return $menu;
    }

    public function logout() {
        $this->autoRender = false;

        $session = $this->request->session();
        $session->delete('empid');
        $session->delete('company_id');
        $this->Auth->logout();
        $this->redirect(['action' => 'login']);
    }

    public function gotoDashboard() {
        $this->redirect(['controller' => 'Pages', 'action' => 'dashboard']);
    }

}
