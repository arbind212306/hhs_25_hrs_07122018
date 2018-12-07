<?php

// src/Controller/ShiftregularizationsController.php

namespace App\Controller;

class ShiftRegularizationController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        /*$shiftRegularizations = $this->Paginator->paginate($this->ShiftRegularization->find());*/
        $shiftRegularizations = $this->Paginator->paginate($this->ShiftRegularization->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('shiftRegularizations'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->ShiftRegularization->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $shiftregularizations =  $this->ShiftRegularization->get($id);
             
        $this->set(compact('shiftcategory'));
    }
    
    
    public function edit($id)
{
     $shiftregularizations =  $this->ShiftRegularization->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->ShiftRegularization->patchEntity($shiftregularizations, $this->request->getData());
        if ($this->ShiftRegularization->save($shiftregularizations)) {
            $this->Flash->success(__('Shift category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift category.'));
    }

    $this->set('shiftregularizations', $shiftregularizations);
}

public function add()
    {
        $shiftregularizations = $this->ShiftRegularization->newEntity();
        if ($this->request->is('post')) {
            $shiftregularizations = $this->ShiftRegularization->patchEntity($shiftregularizations, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$shiftregularizations->user_id = 1;

            if ($this->ShiftRegularization->save($shiftregularizations)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('shiftregularizations', $shiftregularizations);
    }
    

    
    
    public function delete($id)
{
    //$this->request->allowMethod(['post', 'delete']);

    //$article = $this->ShiftRegularization->findBySlug($slug)->firstOrFail();
    $shiftregularizations =  $this->ShiftRegularization->get($id);
    if ($this->ShiftRegularization->delete($shiftregularizations)) {
        $this->Flash->success(__('The {0} article has been deleted.', $shiftregularizations->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

