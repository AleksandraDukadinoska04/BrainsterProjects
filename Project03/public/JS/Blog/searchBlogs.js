$(document).ready(function() {
  
    $('#searchBlogs').on('keyup', function() {
        var query = $(this).val();  
        $.ajax({
            url: "/blogs/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#blogs-table').html(data);
            }
        });
    });
});

