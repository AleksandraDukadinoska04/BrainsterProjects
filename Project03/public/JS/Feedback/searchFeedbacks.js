$(document).ready(function() {
  
    $('#searchFeedbacks').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/feedbacks/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#feedbacks-table').html(data);
            }
        });
    });
});

