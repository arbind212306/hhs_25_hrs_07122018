<?php

// src/Controller/ShiftmasterController.php

namespace App\Controller;
use Cake\Routing\Router;



class UserRosterController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        //$roster = $this->Paginator->paginate($this->UserRoster->find());
        //$this->set(compact('rosters'));
        
        //$from_date = date('Y-01-01');
                
        /*$todate = date('Y-m-t');*/
		//$todate = date('Y').'-12-31';
        
         //$empid =  $this->request->session()->read('empid');
         //$companyID =  $this->request->session()->read('company_id');
        //$empid = 't-546';
                
       /* $roster = $this->UserRoster->viewRoster($from_date,$todate,$empid);*/
        
        /*$roster = $this->UserRoster->viewRoster($from_date,$todate,$empid,$companyID);
        
        $this->set('roster', $roster);*/
        
        
    }
    
    public function view()
    {
    
	    $companyID =  $this->request->session()->read('company_id');
		 
		$empid =  strtolower($this->request->session()->read('empid'));
		
		
        if ($this->request->is('get')) {
			
		 $data = $this->request->query();
		 
		 
		$from_date = $data['start'];
		 $todate = $data['end'];
		
		 $roster = $this->UserRoster->viewRoster($from_date,$todate,$empid,$companyID);
		
		
		 $this->set('roster', $roster);
		
	    }
		
		 	 
	 
      /* $roster = $this->UserRoster->find('list', 
                   array('conditions'=>array('id'=>$id)));
          
       $roster =  $this->UserRoster->get($id);
             
        $this->set(compact('shift'));*/
    }
    
    
    public function edit($id)
{
     $roster =  $this->UserRoster->get($id);
     
	   $companyID =  $this->request->session()->read('company_id');
       $shifts =  $this->UserRoster->getShifts($companyID);
       
        $this->set('shifts', $shifts);
        
    if ($this->request->is(['post', 'put'])) {
        $this->UserRoster->patchEntity($roster, $this->request->getData());
        if ($this->UserRoster->save($roster)) {
            $this->Flash->success(__('Shift has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift.'));
    }

    $this->set('roster', $roster);
}

public function add()
    {
        $roster = $this->UserRoster->newEntity();
        
        $companyID =  $this->request->session()->read('company_id');
        $shifts =  $this->UserRoster->getShifts($companyID);
       
        $this->set('shifts', $shifts);
        
        if ($this->request->is('post')) {
            $roster = $this->UserRoster->patchEntity($roster, $this->request->getData());

            $data = $this->request->getData();
            
            $stmt =  $this->UserRoster->saveRoster($data);
         
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$roster->user_id = 1;

            /*if ($this->UserRoster->save($roster)) {*/
                
               if ($stmt) {
               
                $this->Flash->success(__('Roster has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add Roster.'));
        }
        $this->set('roster', $roster);
    }
    
       public function delete($id)
        {
            $this->request->allowMethod(['post', 'delete']);

            //$article = $this->Shiftcategory->findBySlug($slug)->firstOrFail();
            $roster =  $this->UserRoster->get($id);
            if ($this->UserRoster->delete($roster)) {
                $this->Flash->success(__('The {0} article has been deleted.', $roster->name));
                return $this->redirect(['action' => 'index']);
            }
        }
		
		
		
				
	  public function setteamroster()
     {
		 
		 
		 
		 
		 
		 
		 $companyID =  $this->request->session()->read('company_id');
		 
		$supID =  strtolower($this->request->session()->read('empid'));
		 $shifts =  $this->UserRoster->getShifts($companyID);
		 
		 $emplist = $this->UserRoster->getEmnpList($supID,$companyID);
		$this->set('emplist', $emplist);
       
        $this->set('shifts', $shifts);
		
		
        if ($this->request->is('post')) {
	    $data = $this->request->getData();
		
		/*echo "<pre>";
		 print_r($data);
		 
		 exit;
		*/
			 
		    $stmt =   $this->UserRoster->saveTeamRoster($data);
			  
			  if ($stmt) {
               
                $this->Flash->success(__('Roster has been saved.'));
                return $this->redirect(['action' => 'setteamroster']);
            }
            $this->Flash->error(__('Unable to add Roster.'));
		
	  }
	
      
    }
	
	
	 public function viewteamroster()
     {
		$companyID =  $this->request->session()->read('company_id');
		 
		$supID =  strtolower($this->request->session()->read('empid'));
		
		$emplist = $this->UserRoster->getEmnpList($supID,$companyID);
		$this->set('emplist', $emplist);
       
		
        if ($this->request->is('post')) {
	    $data = $this->request->getData();
		
		
		 echo $this->UserRoster->getRosterList($data);
		 exit; 
			 
		 
		
	    }
	
	 }
	

}