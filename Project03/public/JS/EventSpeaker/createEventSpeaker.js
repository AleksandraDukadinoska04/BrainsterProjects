$(document).ready(function() {
    $('#eventSpeaker-form').on('submit', function(event) {
        event.preventDefault(); 
        $('.error-message').html('');


        var formData = {
            event_id: $('#event_id').val(),
            speaker_id: $('#speaker_id').val(),
            speaker_type: $('#speaker_type').val(),
            speaker_invitation: $('#speaker_invitation').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/event/speakers/create/' , 
                    type: 'POST',
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                $('#eventSpeaker-form')[0].reset();
 
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