$(document).ready(function(){

    $('.filter-autosubmitform').change(function(){
      $(this).parent().submit();
    });

    $('.datetime-picker').datetimepicker();
});


