$(document).ready(function() {
    $('#event-form').on('submit', function(event) {
        event.preventDefault(); 
        $('.error-message').html('');

        
        var formData = {
            title_id: $('#title_id').val(),
            img: $('#img').val(),
            theme: $('#theme').val(),
            description: $('#description').val(),
            objective: $('#objective').val(),
            location: $('#location').val(),
            date: $('#date').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/events/create', 
                    type: 'POST',
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = "/events"; 
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