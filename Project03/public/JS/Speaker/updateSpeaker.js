
$(document).ready(function() {
    $('#edit-speaker-form').on('submit', function(event) {
        event.preventDefault(); 

        $('.error-message').html('');

        
        var speakerId = $(this).data('id'); 
        
        var formData = {
            name: $('#name').val(),
            surname: $('#surname').val(),
            img: $('#img').val(),
            profession: $('#profession').val(),
            linkedin: $('#linkedin').val(),
            facebook: $('#facebook').val(),
            instagram: $('#instagram').val(),
            twitter: $('#twitter').val(),

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
                    url: '/speakers/' + speakerId + '/edit', 
                    type: 'PUT', 
                    data: formData, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = '/speakers'; 
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