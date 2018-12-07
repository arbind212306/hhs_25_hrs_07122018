<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class NatureOfEmploymentController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        
             
        /*$Natureofemployments= $this->Paginator->paginate($this->NatureOfEmployment->find());*/
                
        $Natureofemployments= $this->Paginator->paginate($this->NatureOfEmployment->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('Natureofemployments'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->NatureOfEmployment->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Natureofemployment=  $this->NatureOfEmployment->get($id);
             
        $this->set(compact('Natureofemployment'));
    }
    
    
    public function edit($id)
{
     $Natureofemployment =  $this->NatureOfEmployment->get($id);
     
     
             
    if ($this->request->is(['post', 'put'])) {
        $this->NatureOfEmployment->patchEntity($Natureofemployment, $this->request->getData());
        if ($this->NatureOfEmployment->save($Natureofemployment)) {
            $this->Flash->success(__('Nature category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update Nature category.'));
    }

    $this->set('Natureofemployment', $Natureofemployment);
}

public function add()
    {
        $Natureofemployment = $this->NatureOfEmployment->newEntity();
        if ($this->request->is('post')) {
            $Natureofemployment = $this->NatureOfEmployment->patchEntity($Natureofemployment, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$Natureofemployment->user_id = 1;

            if ($this->NatureOfEmployment->save($Natureofemployment)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('Natureofemployment', $Natureofemployment);
    }
    

    
    
    public function delete($id)
{
   // $this->request->allowMethod(['post', 'delete']);

    //$article = $this->NatureOfEmployment->findBySlug($slug)->firstOrFail();
    $Natureofemployment =  $this->NatureOfEmployment->get($id);
    if ($this->NatureOfEmployment->delete($Natureofemployment)) {
        $this->Flash->success(__('The {0} article has been deleted.', $Natureofemployment->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

