$(document).ready(function() {
  
    $('#searchEmployees').on('keyup', function() {
        var query = $(this).val(); 

      
        $.ajax({
            url: "/employees/search", 
            method: 'GET',
            data: { search: query },
            success: function(data) {
              
                $('#employees-table').html(data);
            }
        });
    });
});

