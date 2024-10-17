$(document).ready(function() {
    $('#ticket-form').on('submit', function(event) {
        event.preventDefault();
        var event_id = $('#event_id').val();

        $('.error-message').html('');

    
        var formData = {
            event_id: event_id,
            ticket_type: $('#ticket_type').val(),
            price: $('#price').val(),
            quantity: $('#quantity').val(),
            seats: $('#seats').val(),
            pauses: $('#pauses').val(),
            wifi: $('#wifi').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/event/ticket/create',
                    type: 'POST', 
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                $('#ticket-form')[0].reset();

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