$(function() {

	var pusher = new Pusher('71c01d28f261f9c7f73e');
    var channel = pusher.subscribe('adminChannel');


    channel.bind('employeeWasAdded', function(data) {
        //Prepend the user's record in the table
        $('table tbody').prepend($(data.tablerowcontent));
    });

    channel.bind('employeeDetailsWasChanged', function(data) {
        //Changes the user's record from the table if exist
        $('table tbody tr').each(function(index){
            if($(this).data('userid') == data.userid){
                $(this).replaceWith($(data.tablerowcontent));
                return false;
            }
        });
    });

    channel.bind('employeeWasRemoved', function(data) {
        //Remove the user record from the table if exist
        $('table tbody tr').each(function(index){
            if($(this).data('userid') == data.userid){
                $(this).remove();
                return false;
            }
        });

    });
});