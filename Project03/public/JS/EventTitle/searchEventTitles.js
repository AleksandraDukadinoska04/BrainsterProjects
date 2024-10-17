$(document).ready(function() {
  
    $('#searchEventTitles').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/event/titles/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#eventTitles-table').html(data);
            }
        });
    });
});

