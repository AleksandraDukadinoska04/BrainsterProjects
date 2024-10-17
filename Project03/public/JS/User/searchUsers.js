$(document).ready(function() {
  
    $('#searchUsers').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/users/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#users-table').html(data);
            }
        });
    });
});

