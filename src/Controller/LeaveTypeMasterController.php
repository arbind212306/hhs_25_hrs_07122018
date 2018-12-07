<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class LeaveTypeMasterController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        /*$Leavetypes= $this->Paginator->paginate($this->LeaveTypeMaster->find());*/
        $Leavetypes= $this->Paginator->paginate($this->LeaveTypeMaster->find('all')
                ->where(['company_id =' => $company_id]));
        $this->set(compact('Leavetypes'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->LeaveTypeMaster->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Leavetye=  $this->LeaveTypeMaster->get($id);
             
        $this->set(compact('Leavetye'));
    }
    
    
    public function edit($id)
{
   
    $company_id = $this->request->session()->read('company_id'); 
    $Leavetyes= $this->LeaveTypeMaster->getLeaveType($id ,$company_id);
    $this->set('leavetypes',  $Leavetyes);
    
   
     $Natureofemployment_cat = $this->LeaveTypeMaster->getNatureCategory($company_id);
     $this->set('Natureofemployment_cat', $Natureofemployment_cat);
     
     $roles = $this->LeaveTypeMaster->getRoles($company_id);
        $this->set('roles', $roles);
    
    $Leavetye=  $this->LeaveTypeMaster->get($id);
    if ($this->request->is(['post', 'put'])) {
        
        $data = $this->request->getData();
		
		
         
        if($data['nature_of_employement'])
        $data['nature_of_employement'] = implode(',', $data['nature_of_employement']);
        
        if($data['allowed_with_leave_type'])
        $data['allowed_with_leave_type'] = implode(',', $data['allowed_with_leave_type']);
	
	
	    
        
        //$this->LeaveTypeMaster->patchEntity($Leavetye, $this->request->getData());
        $this->LeaveTypeMaster->patchEntity($Leavetye, $data);
        
        if ($this->LeaveTypeMaster->save($Leavetye)) {
            $this->Flash->success(__('Leave has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update Leave category.'));
    }

    $this->set('leavetype', $Leavetye);
}

public function add()
    {   
        $company_id = $this->request->session()->read('company_id'); 
        $Leavetyes= $this->LeaveTypeMaster->getLeaveType('',$company_id);
        $this->set('leavetypes',  $Leavetyes);
        
       $Natureofemployment_cat = $this->LeaveTypeMaster->getNatureCategory($company_id);
        $this->set('Natureofemployment_cat', $Natureofemployment_cat);
        
        $roles = $this->LeaveTypeMaster->getRoles($company_id);
        $this->set('roles', $roles);
       

        $leavetype = $this->LeaveTypeMaster->newEntity();
        if ($this->request->is('post')) {
            
            
            $data = $this->request->getData();
         
            if($data['nature_of_employement'])
            $data['nature_of_employement'] = implode(',', $data['nature_of_employement']);
            //$this->LeaveTypeMaster->patchEntity($leavetype, $this->request->getData());
            $leavetype = $this->LeaveTypeMaster->patchEntity($leavetype, $data);

            //$leavetype = $this->LeaveTypeMaster->patchEntity($leavetype, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$Attendancecategory->user_id = 1;

            if ($this->LeaveTypeMaster->save($leavetype)) {
                $this->Flash->success(__('Leave category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add Leave category.'));
        }
        $this->set('leavetype', $leavetype);
    }
    

    
    
    public function delete($id)
{
    //$this->request->allowMethod(['post', 'delete']);

    //$article = $this->LeaveTypeMaster->findBySlug($slug)->firstOrFail();
    $leavetype =  $this->LeaveTypeMaster->get($id);
    if ($this->LeaveTypeMaster->delete($leavetype)) {
        $this->Flash->success(__('The {0} Leave has been deleted.', $leavetype->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

