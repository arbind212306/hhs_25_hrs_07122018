<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class AttendanceCategoryController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        
             
        $Attendancecategorys= $this->Paginator->paginate($this->AttendanceCategory->find());
                
        /*$Attendancecategorys= $this->Paginator->paginate($this->AttendanceCategory->find('all')
                ->where(['company_id =' => $company_id]));*/
        
        $this->set(compact('Attendancecategorys'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->AttendanceCategory->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Attendancecategory=  $this->AttendanceCategory->get($id);
             
        $this->set(compact('Attendancecategory'));
    }
    
    
    public function edit($id)
{
     $Attendancecategory =  $this->AttendanceCategory->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->AttendanceCategory->patchEntity($Attendancecategory, $this->request->getData());
        if ($this->AttendanceCategory->save($Attendancecategory)) {
            $this->Flash->success(__('Shift category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift category.'));
    }

    $this->set('shiftcategory', $Attendancecategory);
}

public function add()
    {
        $Attendancecategory = $this->AttendanceCategory->newEntity();
        if ($this->request->is('post')) {
            $Attendancecategory = $this->AttendanceCategory->patchEntity($Attendancecategory, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$Attendancecategory->user_id = 1;

            if ($this->AttendanceCategory->save($Attendancecategory)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('shiftcategory', $Attendancecategory);
    }
    

    
    
    public function delete($id)
{
   // $this->request->allowMethod(['post', 'delete']);

    //$article = $this->AttendanceCategory->findBySlug($slug)->firstOrFail();
    $Attendancecategory =  $this->AttendanceCategory->get($id);
    if ($this->AttendanceCategory->delete($Attendancecategory)) {
        $this->Flash->success(__('The {0} article has been deleted.', $Attendancecategory->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

