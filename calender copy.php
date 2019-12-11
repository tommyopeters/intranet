 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
<!-- Useful Links -->
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
        $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:false,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
  </script>

      
    <title>BTM Circle</title>
</head>
<body>
<!-- Navigation -->
<?php
include('header.php')
?>

<!-- Calender Plugin -->
<div class="container">
    <div id="calendar"></div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-cols">
            <ul class="col1">
                <li>BTM Circle</li>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum dignissimos quia quod, expedita dolorem ipsa pariatur aspernatur ullam aperiam dolor, in similique repudiandae autem reiciendis voluptatem sequi nulla est omnis!</p>
            </ul>
            
            <ul class="col2">
                <li>Useful Links</li>
                <li><a href="192.168.83.230">Mail 2</a></li>
                <li><a href="192.168.83.231">Mail 3</a></li>
                <li><a href="http://192.168.83.208/nucorelib/basic_users/login">TRAACS</a></li>
                <li><a href="197.255.61.206">TBF</a></li>
                <li><a href="journeyeasy.net">Journeyeasy</a></li>
                <li><a href="https://192.168.83.226:8008/">Enclave</a></li>
            </ul>
        </div>
    </div>
    <hr>
        <div class="footer-bottom text-center">
        Copyright &copy; 2019 <a href="http://btmlimited.net/">BTML</a>
        </div>
</footer>

</body>
</html>