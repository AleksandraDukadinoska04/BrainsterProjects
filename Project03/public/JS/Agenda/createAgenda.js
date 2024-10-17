$(document).ready(function() {
    $('#agenda-form').on('submit', function(event) {
        event.preventDefault(); 
        var event_id = $('#event_id').val();

        $('.error-message').html('');

    
        var formData = {
            event_id: event_id,
            day: $('#day').val(),
            hour: $('#hour').val(),
            title: $('#title').val(),
            description: $('#description').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/event/agenda/create', 
                    type: 'POST', 
                    data: $(this).serialize(),
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                $('#agenda-form')[0].reset();
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