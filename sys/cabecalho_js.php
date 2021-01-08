<?php // Breno Cruvinel - breno.cruvinel09@gmail.com
if(!isset($SCRIPTJS)){ $SCRIPTJS = "1";
?>
<script>
$(document).ready(function() {
	/*/ Calendar (fullcalendar)
	if($('.calendar').length > 0)
	{
		$('.calendar').fullCalendar({
			header: {
				left: '',
				center: 'prev,title,next',
				right: 'month,agendaWeek,agendaDay,today'
			},
			buttonText:{
				today:'Hoje'
			},
			editable: true,
			axisFormat: 'H:mm', //,'h(:mm)tt',
        	timeFormat: {
    			agenda: 'H(:mm)' //h:mm{ - h:mm}'
    		}
		});
		$(".fc-button-effect").remove();
		$(".fc-button-next .fc-button-content").html("<i class='icon-chevron-right'></i>");
		$(".fc-button-prev .fc-button-content").html("<i class='icon-chevron-left'></i>");
		$(".fc-button-today").addClass('fc-corner-right');
		$(".fc-button-prev").addClass('fc-corner-left');
	}//*/
	
});



</script>
<?php
}//if($SCRIPTJS == "1"){

?>