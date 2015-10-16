$(document).ready(function(){

	$('.filter-autosubmitform').prop('selectedIndex', -1);

    $('.filter-autosubmitform').change(function(){
      $(this).parent().submit();
    });

    $('.datetime-picker').datetimepicker();
});


