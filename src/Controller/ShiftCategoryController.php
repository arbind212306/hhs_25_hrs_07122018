<?php

// src/Controller/ShiftcategoryController.php

namespace App\Controller;

class ShiftCategoryController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
        /*$shiftCategorys= $this->Paginator->paginate($this->ShiftCategory->find());*/
        $shiftCategorys= $this->Paginator->paginate($this->ShiftCategory->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('shiftCategorys'));
    }
    
    public function view($id = null)
    {
     
       /*$shiftCategory = $this->ShiftCategory->find('list', 
                   array('conditions'=>array('id'=>$id)));*/
          
       $shshiftcategory =  $this->ShiftCategory->get($id);
             
        $this->set(compact('shiftcategory'));
    }
    
    
    public function edit($id)
{
     $shiftcategory =  $this->ShiftCategory->get($id);
    if ($this->request->is(['post', 'put'])) {
        $this->ShiftCategory->patchEntity($shiftcategory, $this->request->getData());
        if ($this->ShiftCategory->save($shiftcategory)) {
            $this->Flash->success(__('Shift category has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift category.'));
    }

    $this->set('shiftcategory', $shiftcategory);
}

public function add()
    {
        $shiftcategory = $this->ShiftCategory->newEntity();
        if ($this->request->is('post')) {
            $shiftcategory = $this->ShiftCategory->patchEntity($shiftcategory, $this->request->getData());

            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$shiftcategory->user_id = 1;

            if ($this->ShiftCategory->save($shiftcategory)) {
                $this->Flash->success(__('Shift category has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add shift category.'));
        }
        $this->set('shiftcategory', $shiftcategory);
    }
    

    
    
    public function delete($id)
{
    //$this->request->allowMethod(['post', 'delete']);

    //$article = $this->ShiftCategory->findBySlug($slug)->firstOrFail();
    $shiftcategory =  $this->ShiftCategory->get($id);
    if ($this->ShiftCategory->delete($shiftcategory)) {
        $this->Flash->success(__('The {0} article has been deleted.', $shiftcategory->name));
        return $this->redirect(['action' => 'index']);
    }
}
    
}

