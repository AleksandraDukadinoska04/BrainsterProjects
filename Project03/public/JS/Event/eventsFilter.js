

$(document).ready(function () {
  
    $('input[name="eventTitle"]').change(function () {
        var selectedEventTitleId = $(this).val();

     
        if (selectedEventTitleId === 'all') {
            $('#eventsTable tr').show();
        } else {
          
            $('#eventsTable tr').each(function () {
                var rowEventTitleId = $(this).data('event-title-id');
                if (rowEventTitleId == selectedEventTitleId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
});