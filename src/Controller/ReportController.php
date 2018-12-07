<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class ReportController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        
             
        /*$Reports= $this->Paginator->paginate($this->Report->find());*/
                
        $Reports= $this->Paginator->paginate($this->Report->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('Reports'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->Report->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $Report=  $this->Report->get($id);
             
        $this->set(compact('Report'));
    }
    
    
    public function edit($id)
{
     $Report =  $this->Report->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->Report->patchEntity($Report, $this->request->getData());
        if ($this->Report->save($Report)) {
            $this->Flash->success(__('Shift category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift category.'));
    }

    $this->set('shiftcategory', $Report);
}

public function add()
    {
        $Report = $this->Report->newEntity();
        if ($this->request->is('post')) {
            $Report = $this->Report->patchEntity($Report, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$Report->user_id = 1;

            if ($this->Report->save($Report)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('shiftcategory', $Report);
    }
    

    
    
    public function delete($id)
{
   // $this->request->allowMethod(['post', 'delete']);

    //$article = $this->Report->findBySlug($slug)->firstOrFail();
    $Report =  $this->Report->get($id);
    if ($this->Report->delete($Report)) {
        $this->Flash->success(__('The {0} article has been deleted.', $Report->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

