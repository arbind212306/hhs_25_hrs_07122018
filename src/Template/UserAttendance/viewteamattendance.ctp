<h3>View Team Attendance</h3>
<hr />

  
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->

  <div class="searchbox">
 
 <!--form id="search"-->
 
 <?php echo $this->Form->create('search', array('id'=>'search')); ?>
 <div class="row"><div class="col-md-3">
  <div class="row"><div class="col-md-12"><div class="form-group"><div class="input text required"><label for="fromdate">Fromdate</label><input type="text" name="fromdate" id="fromdate" placeholder="From Date" autocomplete="off" required class="form-control"></div></div></div>
  </div>
   </div>
   <div class="col-md-3">
  <div class="row">
  <div class="col-md-12">
  <div class="form-group">
  <div class="input text required">
  <label for="todate">Todate</label>
  <input type="text" name="todate" id="todate" placeholder="To Date" autocomplete="off" required class="form-control"></div>
  </div>
  </div>
  </div>
    </div>
 <div class="col-md-4">
 <div class="row">
 <div class="col-md-12">
 <div class="form-group">
   <label for="todate">Employee's</label>
 <?php

	 foreach($emplist as $emp){
         
         $arrEmp[strtolower($emp['emp_id'])]=$emp['empname']."(".strtolower($emp['emp_id']).")";
     }
	 
	 
	 echo $this->Form->input('emp', array('name'=>'emp','type'=>'select', 'options'=>$arrEmp, 'label'=>false, 'class'=>'emp form-control','required'=>'required','multiple'=>'multiple','id'=>'emplist'));
    ?>

  </div>
  </div>
 </div>
 </div>
  </div>
    </div>
	
  
  <div class="row"><div class="col-md-4"><div class="form-group"></div></div></div>
  <button  id="find">Find</button>
  
  
  <?php
    echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
     echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);
	 
	 ?>
 </form>
  <br />
  
  <div class="emprosterlist"  >
  <hr />
<?php 
    
      
     /*echo $this->Form->create();
     echo $this->Form->control('id', ['type' => 'hidden']);
     echo $this->Form->control('empid',['type' => 'hidden','value' => $this->request->session()->read('empid')]);
     echo $this->Form->control('company_id',['type' => 'hidden','value' => $this->request->session()->read('company_id')]);*/
    
?>
  


   

    <table id="jqGrid"></table>
    <div id="jqGridPager"></div>
	
	
	


    <script type="text/javascript"> 
	
	$(document).ready(function () {
		
		/*
            $("#jqGrid").jqGrid({
				
				loadBeforeSend: function(jqXHR) {
					jqXHR.setRequestHeader('X-CSRF-Token', $("input[name=_csrfToken]").val());
				},
                 url: '<?php echo $this->Url->build(['controller'=>'UserRoster','action'=>'setteamroster']); ?>',
                 mtype: "POST",
                 dataType: 'json',
				 postData: {fdata:$('form' ).serialize() },
                colModel: [
                    { label: 'OrderID', name: 'OrderID', key: true, width: 75 },
                    { label: 'Customer ID', name: 'CustomerID', width: 150 },
                    { label: 'Order Date', name: 'OrderDate', width: 150,
					formatter : 'date', formatoptions: { srcformat : 'Y-m-d H:i:s', newformat :'ShortDate'}},
                    { label: 'Freight', name: 'Freight', width: 150 },
                    { label:'Ship Name', name: 'ShipName', width: 150 }
                ],
				viewrecords: true,
                width: 780,
                height: 250,
                rowNum: 20,
                pager: "#jqGridPager"
            });
			
			*/
	$('#setroster').hide();		
	

	 
$('#find').click(function (event) {	


if($('#fromdate').val() ==''){
	alert("Select From Date !")
	
	return false;
}

if($('#todate').val() ==''){
	alert("select To Date !")
	return false;
	
}


	 event.preventDefault();
	
    $.ajax({
			
    url: '<?php echo $this->Url->build(['controller'=>'UserAttendance','action'=>'viewteamattendance']); ?>',
    dataType: "json",
    type: 'POST',
	data :{fdata:$('form' ).serialize() },
	beforeSend: function(request) {
    request.setRequestHeader("X-CSRF-Token",  $("input[name=_csrfToken]").val());
  },
  
    success: function (result) {

        if (result) {

            if (!result.Error) {

			
			
			 
			   console.log(result);
			   
                var colD = result.data;
				
				
                //var colM = result.colModelList;
                var colN = result.columnNames;

                //$("#jqGrid").jqGrid('GridUnload');
				$.jgrid.gridUnload("#jqGrid"); 

                 var ColumnToSave = [];
				 var jsonStr = '{}';
				 //var ColumnToSave = new Array([]);

                $("#jqGrid").jqGrid({ datatype: 'local',
                    colModel: colN,
                    data: colD,
                    
                   
                    //sortname: viewOptionText,
                    sortorder: "desc",
                    pager: '#jqGridPager',
                    //caption: "Side-by-Side View",
					width:1000,
                    toolbarfilter: true,
				    viewrecords: true,
				   multiselect: false,
				   autowidth: true,
				   forceFit: true,
				   shrinkToFit: false,
				   altRows: true,
                   cellEdit: true,
				   cellsubmit: 'clientArray',
				   rownumbers: true,
				   beforeEditCell: function(id, name, val, iRow, iCol) {
					   console.log(name);
							/*if(name=='name') {             
								var listdata = GetLookupValues(id, name);
									if (listdata == null) listdata = "1:1";                              
									jQuery("#jqGrid").setColProp(name, { editoptions: { value: listdata.toString()} })                                
								}*/
								
								 //var grid =  $("#jqGrid");
									
									 //var changedCells = grid.getChangedCells('all');
									 //console.log(changedCells);
							}
				          
							,
							afterEditCell: function(rowid, cellname, value, iRow, iCol) {
								
								
								 var grid =  $("#jqGrid");
									 	 var changedCells = grid.getChangedCells('all');
									 console.log(changedCells);
									 
									$('#setroster').click(function (event) {									 
										event.preventDefault();
									
									$.ajax({
											
									url: '<?php echo $this->Url->build(['controller'=>'UserAttendance','action'=>'setteamattendance']); ?>',
									dataType: "json",
									type: 'POST',
									data :{cdata:changedCells },
									beforeSend: function(request) {
									request.setRequestHeader("X-CSRF-Token",  $("input[name=_csrfToken]").val());
								  },
								  
									success: function (result) {
										
										console.log(result);
										
										
										  },
									error: function (xhr, ajaxOptions, thrownError) {
										if (xhr && thrownError) {
											alert('Status: ' + xhr.status + ' Error: ' + thrownError);
										}
									},
									complete: function () {
										//$("#loadingDiv").hide();
									}
								});

								});
								
								
								
							
								$('#' +iRow+ '_' + cellname).on('change', function() {
									
								 
								    var empid = $(this).closest('tr').find('td:eq(2)').text();
									var rdate = $('#jqgh_jqGrid_'+cellname).text();
									
									
									var arr = {}; 
									var empid = empid;
									var abaa = eval(abaa);
									var shift = this.value;
									var rdate = rdate;
									
									/*arr['shift'] = shift;
									arr['rdate'] = rdate;
									
									
									var obj = JSON.parse(jsonStr);
									
									console.log(jsonStr)
									if(!obj[empid]) {
								          jsonStr = '{"'+empid +'":[]}';
									}
	                                 //jsonStr = JSON.stringify(jsonStr);
									 	console.log(jsonStr)
									
									obj[empid].push({"shift":this.value,"rdate":rdate});
									jsonStr = JSON.stringify(obj);*/


									 //ColumnToSave.push({"empid":empid,status:this.value.trim(),"rdate":rdate});
									 
									//ColumnToSave[empid][rdate]=shift;
									//ColumnToSave[0][empid]=shift;
									//ColumnToSave.push(arr);
									
									//ColumnToSave[empid]= arr;
									
									/*if (typeof ColumnToSave[empid] !== 'undefined' && ColumnToSave[empid].length > 0) {
										ColumnToSave[empid].push(arr);
									}
									else{
										
									ColumnToSave[empid] = new Array();
									ColumnToSave[empid].push(arr);
									
									}*/
									
									
									  
									//console.log(ColumnToSave)
									
									//console.log(ColumnToSave.indexOf(rdate));
									
									
									/*for (i in ColumnToSave) {
											
										console.log(ColumnToSave[i]);
                                        console.log(ColumnToSave[i].empid);										
									}*/
									
									 
									 ///var ret2 = JSON.stringify(changedCells);
									
									
																
								      //console.log(changedCells);
									
									
									$('#rsdata').val(JSON.stringify(ColumnToSave));
								  
								});
														
							/*var select = $(item).find('td.edit-cell select');
							
							
							$(item).find('td.edit-cell select option').each(function() {
									   
								
								var option = $(this);
								var optionId = $(this).val();
								
								console.log("find" +  optionId );	
								
								
								$(lookupData.ListingCategory).each(function() {
									if (this.Id == optionId) {                           
										if (this.OnlineName != $(item).getCell(rowid, 'OnlineName')) {
											option.remove();
											return false;
										}
									}
								});
							});
							*/
							}
						
						  ,
						  ondblClickRow: function(rowid,iRow,iCol,e){
						    console.log('double clicked');
						
						}
						,onCellSelect: function(rowid, index, contents, event) 
                          {    
						  
						  // console.log("onCellSelect" +  rowid + ":" +  index + ":" +  contents + ":" +  event );
						   
						   
							   /*var cm = $("#jqGrid").jqGrid('getGridParam','colModel'); 

                                console.log(rowid);								   
							   if(cm[index].name == "name")
							   {
								   fnName(rowid);
								   
								  
							   }*/
							}
						});

                $('#setroster').show();
                //Update grid params so that subsequent interactions with the grid for sorting,paging etc. will be server-side
                
				
			
								


            }
        }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        if (xhr && thrownError) {
            alert('Status: ' + xhr.status + ' Error: ' + thrownError);
        }
    },
    complete: function () {
        $("#loadingDiv").hide();
    }
});
      
        });
		
		




  });
   </script>
   <input type="hidden" name="rsdata" id= "rsdata" value ="" />
   <input type="hidden" name="task"  value ="setteamattendance" />
   <?php
    /*
    echo $this->Form->button(__('Set Attendance'),['id'=>'setroster']);
    echo $this->Form->end();*/
	
?>
</div>

 <?php 

echo $this->Html->css(array('ui.jqgrid','jquery-ui'));

 ?>
 <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.1/themes/start/jquery-ui.css" />

<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/grid.locale-en.js"></script>

<link rel="stylesheet" href="<?php echo $this->Url->build('/');?>/css/bootstrap-multiselect.css" type="text/css">

<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo $this->Url->build('/');?>/js/prettify.min.js"></script>


<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style>
#gbox_jqGrid{    z-index: 0;}
</style>

<script>
  $(function() {
    $( "#todate,#fromdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });

    $(document).ready(function() {
        $('#emplist').multiselect(
		{
			includeSelectAllOption: true,
			enableCaseInsensitiveFiltering: true,
            enableFiltering: true,
			maxHeight: 200
		});
    });
</script>