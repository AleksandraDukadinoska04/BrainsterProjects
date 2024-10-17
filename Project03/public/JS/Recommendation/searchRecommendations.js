$(document).ready(function() {
  
    $('#searchRecommendations').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/recommendations/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#recommendations-table').html(data);
            }
        });
    });
});

