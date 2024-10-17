
$(document).ready(function() {
    $('#edit-ticket-form').on('submit', function(event) {
        event.preventDefault(); 
        
        var ticketId = $(this).data('id'); 

        $('.error-message').html('');
        
       
        var formData = {
            ticket_type: $('#ticket_type').val(),
            price: $('#price').val(),
            quantity: $('#quantity').val(),
            seats: $('#seats').val(),
            pauses: $('#pauses').val(),
            wifi: $('#wifi').val(),

            _token: $('meta[name="csrf-token"]').attr('content')
        };

   
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to update this user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/event/ticket/' + ticketId + '/edit', 
                    type: 'PUT',
                    data: formData, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then(() => {
                             
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
            }
        });
    });
});