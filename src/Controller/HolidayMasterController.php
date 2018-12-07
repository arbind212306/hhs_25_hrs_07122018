<?php

// src/Controller/ShiftmasterController.php

namespace App\Controller;



class HolidayMasterController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        $company_id = $this->request->session()->read('company_id');
       /* $holidays = $this->Paginator->paginate($this->HolidayMaster->find());*/
        $holidays = $this->Paginator->paginate($this->HolidayMaster->find('all')
                ->where(['company_id =' => $company_id]));
        
        $this->set(compact('holidays'));
        
        //$from_date = date('Y-m-01');
                
        //$todate = date('Y-m-t');
        
        //$empid = 't-546';
                
        //$holiday = $this->HolidayMaster->viewHolidays($from_date,$todate,$empid);
        
        //$this->set('holiday', $holiday);
        
        
    }
    
    public function view($id = null)
    {
     
       $holiday = $this->HolidayMaster->find('list', 
                   array('conditions'=>array('id'=>$id)));
          
       $holiday =  $this->HolidayMaster->get($id);
             
        $this->set(compact('holiday'));
    }
    
    
    public function edit($id)
{
     $holiday =  $this->HolidayMaster->get($id);
     
       $shifts =  $this->HolidayMaster->getShifts();
       
        $this->set('holiday', $shifts);
        
    if ($this->request->is(['post', 'put'])) {
        $this->HolidayMaster->patchEntity($holiday, $this->request->getData());
        if ($this->HolidayMaster->save($holiday)) {
            $this->Flash->success(__('Holiday has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift.'));
    }

    $this->set('holiday', $holiday);
}

public function add()
    {
        $holiday = $this->HolidayMaster->newEntity();
        
        $shifts =  $this->HolidayMaster->getShifts();
       
        $this->set('shifts', $shifts);
        
        if ($this->request->is('post')) {
            $holiday = $this->HolidayMaster->patchEntity($holiday, $this->request->getData());

            $data = $this->request->getData();
            
            $stmt =  $this->HolidayMaster->saveHolidays($data);
         
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$holiday->user_id = 1;

            /*if ($this->HolidayMaster->save($holiday)) {*/
                
               if ($stmt) {
               
                $this->Flash->success(__('Holiday has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add Roster.'));
        }
        $this->set('holiday', $holiday);
    }
    
       public function delete($id)
        {
           
          
            //$this->request->allowMethod(['post', 'delete']);
             //echo "fsaf";exit;
            //$article = $this->Shiftcategory->findBySlug($slug)->firstOrFail();
            $holiday =  $this->HolidayMaster->get($id);
            if ($this->HolidayMaster->delete($holiday)) {
                $this->Flash->success(__('The {0} Holiday has been deleted.', $holiday->reason));
                return $this->redirect(['action' => 'index']);
            }
        }

}