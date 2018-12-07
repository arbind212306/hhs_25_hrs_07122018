<?php

// src/Controller/ShiftmasterController.php

namespace App\Controller;



class UserAttendanceController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        //$roster = $this->Paginator->paginate($this->UserAttendance->find());
        //$this->set(compact('rosters'));
        
        
        //echo '<pre>';
        //print_r($this->request->getData());
        //print_r($this->request->query('ttt'));
        
        //echo '</pre>';
        
       // $fromdate = date('Y-m-01');
		/*$fromdate = date('Y-01-01');
        //$todate = date('Y-m-t');
		$todate = date('Y').'-12-31';

        $empid =  $this->request->session()->read('empid');
        $companyID =  $this->request->session()->read('company_id');

         $attendance = $this->UserAttendance->viewAttendance($fromdate,$todate,$empid,$companyID);
		
		
		 //$bms = $this->UserAttendance->getBMSdata($fromdate,$todate,$empid);
		 
		 
		 //$attendance_json = json_encode(array_merge($attendance,$bms));
		 $attendance_json = json_encode($attendance);
        
        
        $this->set('attendance', $attendance_json);*/
        
        
    }
    
  
    public function view()
    {
     
	    $empid =  $this->request->session()->read('empid');
        $companyID =  $this->request->session()->read('company_id');

		
		
		  if ($this->request->is('get')) {
			
		  $data = $this->request->query();
		 
		 
		 $fromdate = $data['start'];
		 $todate = $data['end'];
         $attendance = $this->UserAttendance->viewAttendance($fromdate,$todate,$empid,$companyID);
		
		
		 //$bms = $this->UserAttendance->getBMSdata($fromdate,$todate,$empid);
		 
		 
		 //$attendance_json = json_encode(array_merge($attendance,$bms));
		 $attendance_json = json_encode($attendance);
		 
		  $this->set('attendance', $attendance_json);
		  
		  }
		 
      /* $roster = $this->UserAttendance->find('list', 
                   array('conditions'=>array('id'=>$id)));
          
       $roster =  $this->UserAttendance->get($id);
             
        $this->set(compact('shift'));*/
    }
    
    
    public function edit($id)
{
     $roster =  $this->UserAttendance->get($id);
     
       $cats =  $this->UserAttendance->getAttCat();
       
        $this->set('cats', $cats);
        
    if ($this->request->is(['post', 'put'])) {
        $this->UserAttendance->patchEntity($roster, $this->request->getData());
        if ($this->UserAttendance->save($roster)) {
            $this->Flash->success(__('Shift has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift.'));
    }

    $this->set('roster', $roster);
}

public function add()
    {
    
    $from_date = date('Y-m-01');
    //$todate = date('Y-m-t');
	$todate = date('Y').'-12-31';
        
    $empid =  $this->request->session()->read('empid');
    $custid =  $this->request->session()->read('company_id');
   
     
     //$pendingAttendance =  $this->UserAttendance->pendingAttendance($empid,$custid);
     $pendingAttendance =  $this->UserAttendance->pendingAttendance($from_date,$todate,$empid,$custid);
     
     $this->set('pendingAttendance', $pendingAttendance);
    
      $roster = $this->UserAttendance->newEntity();
        
      $cats =  $this->UserAttendance->getAttCat($custid);
       
      $this->set('cats', $cats);
        
        if ($this->request->is('post')) {
            $roster = $this->UserAttendance->patchEntity($roster, $this->request->getData());

            $data = $this->request->getData();
			
			
            
            $stmt =  $this->UserAttendance->markAttendance($data);
         
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$roster->user_id = 1;

            /*if ($this->UserAttendance->save($roster)) {*/
                
				
				
               if ($stmt[0]['error_flag'] =='1' ) {
               
                   $this->Flash->error(__($stmt[0]['msg']));
               }
			   else{
				   $this->Flash->success(__('Attendance has been saved.'));
                   return $this->redirect(['action' => 'index']); 
				   
			   }
			   
            
        }
        //  $this->set('roster', $roster);
    }
    
       public function delete($id)
        {
            //$this->request->allowMethod(['post', 'delete']);

            //$article = $this->Shiftcategory->findBySlug($slug)->firstOrFail();
            $roster =  $this->UserAttendance->get($id);
            if ($this->UserAttendance->delete($roster)) {
                $this->Flash->success(__('The {0} article has been deleted.', $roster->name));
                return $this->redirect(['action' => 'index']);
            }
        }
		
		
		
		 
		
		
    public function setteamattendance()
     {
		 
		$companyID =  $this->request->session()->read('company_id');
		 
		$supID =  strtolower($this->request->session()->read('empid'));
		$shiftcat =  $this->UserAttendance->getAttCat($companyID);
		 
		$emplist = $this->UserAttendance->getEmnpList($supID,$companyID);
		$this->set('emplist', $emplist);
		$this->set('shiftcat', $shiftcat);
		 
        if ($this->request->is('post')) {
	    $data = $this->request->getData();
		
		
		
	
		
		  $stmt =   $this->UserAttendance->markTeamAttendance($data);
			  
			/*  if ($stmt) {
               
                $this->Flash->success(__('Attendance has been saved.'));
                return $this->redirect(['action' => 'setteamattendance']);
            }
            $this->Flash->error(__('Unable to add Attendance.'));*/
			
			 if ($stmt[0]['error_flag'] =='1' ) {
               
                   $this->Flash->error(__($stmt[0]['msg']));
               }
			   else{
				   $this->Flash->success(__($stmt[0]['msg']));
                   return $this->redirect(['action' => 'index']); 
				   
			   }
		
		
	  }
	
      
	 }
	  
	 public function viewteamattendance()
     {
		 
		 
		 $companyID =  $this->request->session()->read('company_id');
		 
		$supID =  strtolower($this->request->session()->read('empid'));
		
		 
		$emplist = $this->UserAttendance->getEmnpList($supID,$companyID);
			$this->set('emplist', $emplist);
		
        if ($this->request->is('post')) {
	    $data = $this->request->getData();
		
		
		
		 echo $this->UserAttendance->getAttedanceList($data);
		 exit; 
		
		
	     }
	
      
    }

}