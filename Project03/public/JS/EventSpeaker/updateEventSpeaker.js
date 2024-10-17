
$(document).ready(function() {
    $('#edit-eventSpeaker-form').on('submit', function(event) {
        event.preventDefault(); 
        
        var speakerId = $(this).data('id'); 
        $('.error-message').html('');

        
        var formData = {
            speaker_id: $('#speaker_id').val(),
            speaker_type: $('#speaker_type').val(),
            speaker_invitation: $('#speaker_invitation').val(),

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
                    url: '/event/speakers/' + speakerId + '/edit', 
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