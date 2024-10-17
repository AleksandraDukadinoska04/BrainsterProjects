$(document).ready(function() {
  
    $('#searchSpeakers').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/speakers/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#speakers-table').html(data);
            }
        });
    });
});

