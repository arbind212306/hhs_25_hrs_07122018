<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class LeaveReasonController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        /*$Leavereasons= $this->Paginator->paginate($this->LeaveReason->find());*/
        $Leavereasons= $this->Paginator->paginate($this->LeaveReason->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('Leavereasons'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->LeaveReason->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Leavereason=  $this->LeaveReason->get($id);
             
        $this->set(compact('Leavereason'));
    }
    
    
    public function edit($id)
{
     $leavereason=   $this->LeaveReason->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->LeaveReason->patchEntity($leavereason, $this->request->getData());
        if ($this->LeaveReason->save($leavereason)) {
            $this->Flash->success(__('Shift category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift category.'));
    }

    $this->set('leavereason', $leavereason);
}

public function add()
    {
        $leavereason=  $this->LeaveReason->newEntity();
        if ($this->request->is('post')) {
            $leavereason=  $this->LeaveReason->patchEntity($leavereason, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$leavereason->user_id = 1;

            if ($this->LeaveReason->save($leavereason)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('leavereason', $leavereason);
    }
    

    
    
    public function delete($id)
{
    //$this->request->allowMethod(['post', 'delete']);

    //$article = $this->LeaveReason->findBySlug($slug)->firstOrFail();
    $Leavereason=   $this->LeaveReason->get($id);
    if ($this->LeaveReason->delete($leavereason)) {
        $this->Flash->success(__('The {0} article has been deleted.', $leavereason->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

