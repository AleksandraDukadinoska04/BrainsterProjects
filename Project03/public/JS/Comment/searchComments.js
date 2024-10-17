$(document).ready(function() {
  
    $('#searchComments').on('keyup', function() {
        var query = $(this).val();  
        $.ajax({
            url: "/comments/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#comments-table').html(data);
            }
        });
    });
});

