<?php

// src/Controller/ShiftmasterController.php

namespace App\Controller;

class ShiftMasterController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        /*$shifts = $this->Paginator->paginate($this->ShiftMaster->find());*/
        $shifts = $this->Paginator->paginate($this->ShiftMaster->find('all')
                ->where(['company_id =' => $company_id]));
        
        
        $this->set(compact('shifts'));
        
        
        
    }
    
    public function view($id = null)
    {
     
       $shift = $this->ShiftMaster->find('list', 
                   array('conditions'=>array('id'=>$id)));
          
       $shift =  $this->ShiftMaster->get($id);
             
        $this->set(compact('shift'));
    }
    
    
    public function edit($id)
{
        $shift =  $this->ShiftMaster->get($id);
     
	 $company_id = $this->request->session()->read('company_id');
        $categorys =  $this->ShiftMaster->getShiftCategory($company_id);
        $regularization =  $this->ShiftMaster->getShiftRegularization($company_id);

        $this->set('categorys', $categorys);
        $this->set('regularization', $regularization);
            
            
    if ($this->request->is(['post', 'put'])) {
        $this->ShiftMaster->patchEntity($shift, $this->request->getData());
        if ($this->ShiftMaster->save($shift)) {
            $this->Flash->success(__('Shift has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift.'));
    }

    $this->set('shift', $shift);
}

public function add()
    {
        $shift = $this->ShiftMaster->newEntity();
		
		 $company_id = $this->request->session()->read('company_id');
        
            $categorys =  $this->ShiftMaster->getShiftCategory($company_id);
            $regularization =  $this->ShiftMaster->getShiftRegularization($company_id);
            
            $this->set('categorys', $categorys);
            $this->set('regularization', $regularization);
        
        
        if ($this->request->is('post')) {
            $shift = $this->ShiftMaster->patchEntity($shift, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            $shift->user_id = 1;

            if ($this->ShiftMaster->save($shift)) {
                $this->Flash->success(__('Shift has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift.'));
        }
        $this->set('shift', $shift);
    }
    
       public function delete($id)
{
    //$this->request->allowMethod(['post', 'delete']);

    //$article = $this->Shiftcategory->findBySlug($slug)->firstOrFail();
    $shift =  $this->ShiftMaster->get($id);
    if ($this->ShiftMaster->delete($shift)) {
        $this->Flash->success(__('The {0} article has been deleted.', $shift->name));
        return $this->redirect(['action' => 'index']);
    }
}

}