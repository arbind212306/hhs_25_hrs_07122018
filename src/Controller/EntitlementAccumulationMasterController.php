<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class EntitlementAccumulationMasterController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        
             
        /*$Entitlements= $this->Paginator->paginate($this->EntitlementAccumulationMaster->find());*/
                
        $Entitlements= $this->Paginator->paginate($this->EntitlementAccumulationMaster->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('Entitlements'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->EntitlementAccumulationMaster->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Entitlement=  $this->EntitlementAccumulationMaster->get($id);
             
        $this->set(compact('Entitlement'));
    }
    
    
    public function edit($id)
{
     $Entitlement =  $this->EntitlementAccumulationMaster->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->EntitlementAccumulationMaster->patchEntity($Entitlement, $this->request->getData());
        if ($this->EntitlementAccumulationMaster->save($Entitlement)) {
            $this->Flash->success(__('Entitlement has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update Entitlement.'));
    }

    $this->set('Entitlement', $Entitlement);
}

public function add()
    {
        $Entitlement = $this->EntitlementAccumulationMaster->newEntity();
        if ($this->request->is('post')) {
            $Entitlement = $this->EntitlementAccumulationMaster->patchEntity($Entitlement, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$Entitlement->user_id = 1;

            if ($this->EntitlementAccumulationMaster->save($Entitlement)) {
                $this->Flash->success(__('Entitlement has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add Entitlement.'));
        }
        $this->set('Entitlement', $Entitlement);
    }
    

    
    
    public function delete($id)
{
   // $this->request->allowMethod(['post', 'delete']);

    //$article = $this->EntitlementAccumulationMaster->findBySlug($slug)->firstOrFail();
    $Entitlement =  $this->EntitlementAccumulationMaster->get($id);
    if ($this->EntitlementAccumulationMaster->delete($Entitlement)) {
        $this->Flash->success(__('The {0} Entitlement has been deleted.', $Entitlement->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

