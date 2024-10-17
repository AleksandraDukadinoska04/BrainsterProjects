
$(document).ready(function() {
    $('#edit-event-form').on('submit', function(event) {
        event.preventDefault(); 
        
        var eventId = $(this).data('id'); 

        $('.error-message').html('');

        
        var formData = {
            title_id: $('#title_id').val(),
            img: $('#img').val(),
            theme: $('#theme').val(),
            description: $('#description').val(),
            objective: $('#objective').val(),
            location: $('#location').val(),
            date: $('#date').val(),
            status: $('#status').val(),


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
                    url: '/events/' + eventId + '/edit', 
                    type: 'PUT', 
                    data: formData, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then(() => {
                            
                                window.location.href = '/events'; 
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