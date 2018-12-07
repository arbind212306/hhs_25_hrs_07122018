<h3>View Attendance</h3>
<p><?= $this->Html->link("Self Attendance", ['action' => 'add']) ?></p>

<link href='<?php echo $this->Url->build('/');?>css/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo $this->Url->build('/');?>css/fullcalendar.print.css' rel='stylesheet' media='print' />

<?php

 /*\echo $this->Html->script(array('fullcalendar/lib/moment.min','fullcalendar/lib/jquery.min','fullcalendar/fullcalendar.min'));*/
echo $this->Html->script(array('fullcalendar/lib/moment.min','fullcalendar/fullcalendar.min'));

 ?>

<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',    
        right: 'year,month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '<?php echo date('Y-m-d'); ?>',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
	  <?php /* events:<?php echo $attendance; */ ?>
	  events: '<?php echo $this->Url->build(['controller'=>'UserAttendance','action'=>'view']); ?>'
    });

  });

</script>
<style>

  body {
  
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
span.fc-title {
    color: #fff;
}
</style>

  <div id='calendar'></div>
