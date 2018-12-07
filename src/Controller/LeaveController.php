<?php

// src/Controller/ShiftmasterController.php

namespace App\Controller;



class LeaveController extends AppController
{
    
    public function index()
    {
        $this->loadComponent('Paginator');
        //$roster = $this->Paginator->paginate($this->Leave->find());
        //$this->set(compact('rosters'));
        
        $from_date = date('Y-m-01');
                
        $todate = date('Y-m-t');
        
         $empid =  strtolower($this->request->session()->read('empid'));
         $companyID =  $this->request->session()->read('company_id');
        //$empid = 't-546';
                
       /* $roster = $this->Leave->viewRoster($from_date,$todate,$empid);*/
        
        $leaves = $this->Leave->viewLeave($from_date,$todate,$empid,$companyID);
		  $leavesb = $this->Leave->getLeaveBalance($companyID,$empid);
       
        $this->set('leavesb', $leavesb);
        $this->set('leaves', $leaves);
        
        
        
        $this->set('leaves', $leaves);
        
        
    }
    
    public function view($id = null)
    {
     
       $roster = $this->Leave->find('list', 
                   array('conditions'=>array('id'=>$id)));
          
       $roster =  $this->Leave->get($id);
             
        $this->set(compact('shift'));
    }
    
    
    public function edit($id)
{
     $roster =  $this->Leave->get($id);
     
       $companyID =  $this->request->session()->read('company_id');
       $shifts =  $this->Leave->getLeaveType($companyID);
       
        $this->set('shifts', $shifts);
        
    if ($this->request->is(['post', 'put'])) {
        $this->Leave->patchEntity($roster, $this->request->getData());
        if ($this->Leave->save($roster)) {
            $this->Flash->success(__('Shift has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update shift.'));
    }

    $this->set('roster', $roster);
}

public function add()
    {
        $roster = $this->Leave->newEntity();
        
        $companyID =  $this->request->session()->read('company_id');
        $ltypes =  $this->Leave->getLeaveType($companyID);
       
        $this->set('ltypes', $ltypes);
        
        if ($this->request->is('post')) {
            //$roster = $this->Leave->patchEntity($ltypes, $this->request->getData());

            $data = $this->request->getData();
            
            $stmt =  $this->Leave->saveLeaveRequest($data);
         
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$roster->user_id = 1;

            /*if ($this->Leave->save($roster)) {*/
                
				$error_flag = $stmt[0]['error_flag'];
            
			if ($error_flag == 0) {
               
                $this->Flash->success(__($stmt[0]['msg']));
                return $this->redirect(['action' => 'index']);
            }
			else{
				
				$this->Flash->error(__($stmt[0]['msg']));
				
			}
			
			
            
        }
        $this->set('roster', $roster);
    }
    
       public function delete($id)
        {
            $this->request->allowMethod(['post', 'delete']);

            //$article = $this->Shiftcategory->findBySlug($slug)->firstOrFail();
            $roster =  $this->Leave->get($id);
            if ($this->Leave->delete($roster)) {
                $this->Flash->success(__('The {0} article has been deleted.', $roster->name));
                return $this->redirect(['action' => 'index']);
            }
        }
		
		 function getreport(){
        
			if ($this->request->is('post')) {
			 $data = $this->request->getData();

			 $empid = strtolower($data['empid']);
			 $company_id = $data['company_id'];
			 $fromdate = $data['fromdate'];
			 $todate = $data['todate'];
			
        
             $leaver = $this->Leave->getPayableData($fromdate,$todate,$empid,$company_id); 

             //$this->response->download("export.csv");	
            // $this->set(compact('leaver'));

		     //$this->layout = 'ajax';			 
            }
			else{
				$leaver = array();
			}
             $this->set('reportdata', $leaver);
          }
		  
		  
		  
		   function approveleaverequest(){
        
			
			/* $data = $this->request->getData();
			 $empid = strtolower($data['empid']);
			 $company_id = $data['company_id'];
			 $fromdate = $data['fromdate'];
			 $todate = $data['todate'];*/
			
        
		     
		     $fromdate = date('Y-m-01');
                
             $todate = date('Y-m-t');
        
             $supvervisor =  strtolower($this->request->session()->read('empid'));
             $companyID =  $this->request->session()->read('company_id');
		
             $leaverequest = $this->Leave->getLeaveRequest($fromdate,$todate,'',$companyID,$supvervisor); 		 

             $this->set('leaverequest', $leaverequest);
          }
		  
		  
		  
		  
		   
		   function approveLeaveAction(){
        
			
			 $data = $this->request->getData();
			 //$empid = strtolower($data['empid']);
			 $company_id = $data['company_id'];
			 $leave_id = $data['leave_id'];
			 $status = $data['status'];
			 
			 
			
        
             $supvervisor =  strtolower($this->request->session()->read('empid'));
            // $companyID =  $this->request->session()->read('company_id');
		
             $leaverequest = $this->Leave->SaveLeaveAction($leave_id,$status,$supvervisor); 	

 
			if ($leaverequest) {
               
                $this->Flash->success(__('Leave has been Approved !'));
                return $this->redirect(['action' => 'approveleaverequest']);
            }
			else{
				
				$this->Flash->error(__('Please select action other than Pending !'));
				return $this->redirect(['action' => 'approveleaverequest']);
				
			}			 

             //$this->set('leaverequest', $leaverequest);
          }
		  
		  
		  
		   function approvecompoffrequest(){
        
			
			/* $data = $this->request->getData();
			 $empid = strtolower($data['empid']);
			 $company_id = $data['company_id'];
			 $fromdate = $data['fromdate'];
			 $todate = $data['todate'];*/
			
        
		     
		     $fromdate = date('Y-m-01');
                
             $todate = date('Y-m-t');
        
             $supvervisor =  strtolower($this->request->session()->read('empid'));
             $companyID =  $this->request->session()->read('company_id');
		
             $leaverequest = $this->Leave->getcompoffrequest($fromdate,$todate,'',$companyID,$supvervisor); 		 

             $this->set('leaverequest', $leaverequest);
          }
		  
		   function approvecompoffaction(){
        
			
			 $data = $this->request->getData();
			 
		
			 
			 $emparray = $data['emp'];
			 $company_id = $data['company_id'];
			 $leave_id = $data['leave_id'];
			 $status = $data['status'];
		     $ip = $data['ip'];
        
             $supvervisor =  strtolower($this->request->session()->read('empid'));
            // $companyID =  $this->request->session()->read('company_id');
		
             $leaverequest = $this->Leave->SaveCompoffAction( $company_id,$emparray,$leave_id,$status,$supvervisor,$ip); 	

 
			if ($leaverequest) {
               
                $this->Flash->success(__('Comp OFF has been Approved !'));
                return $this->redirect(['action' => 'approvecompoffrequest']);
            }
			else{
				
				$this->Flash->error(__('Please select action other than Pending !'));
				return $this->redirect(['action' => 'approvecompoffrequest']);
				
			}			 

             //$this->set('leaverequest', $leaverequest);
          }
		  
		  
		  
		   function leavesummary(){
        
				     
		     $fromdate = date('Y-01-01');
                
             $todate = date('Y-m-t');
        
             $emp =  strtolower($this->request->session()->read('empid'));
             $companyID =  $this->request->session()->read('company_id');
		
             $leavesummary = $this->Leave->getleavesummary($fromdate,$todate,$companyID,$emp); 		 

             $this->set('leavesummary', $leavesummary);
          }
		  

}