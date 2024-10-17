$(document).ready(function() {
  
    $('#searchEvents').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/events/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#events-table').html(data);
            }
        });
    });
});

