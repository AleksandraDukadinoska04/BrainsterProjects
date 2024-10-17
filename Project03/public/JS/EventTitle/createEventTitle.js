$(document).ready(function() {
    $('#eventTitle-form').on('submit', function(event) {
        event.preventDefault(); 

        $('.error-message').html('');

    
        var formData = {
            title: $('#title').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/event/titles/create', 
                    type: 'POST', 
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = "/event/titles"; 
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                    
                        if (xhr.status === 422) { 
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $("#" + key + "-error").text(value[0]);
                            });
                        }
                        
                    }
                });
            
       
    });
});