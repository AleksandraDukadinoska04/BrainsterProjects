
$(document).ready(function() {
    $('#edit-generalInfo-form').on('submit', function(event) {
        event.preventDefault(); 

        $('.error-message').html('');

        
        var generalInfoId = $(this).data('id'); 
        
        var formData = {
            hero_title: $('#hero_title').val(),
            hero_image: $('#hero_image').val(),
            logo: $('#logo').val(),
            email: $('#email').val(),
            address: $('#address').val(),
            linkedin: $('#linkedin').val(),
            facebook: $('#facebook').val(),
            instagram: $('#instagram').val(),
            youtube: $('#youtube').val(),

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
                    url: '/generalInfo/' + generalInfoId + '/edit', 
                    type: 'PUT', 
                    data: formData, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = '/generalInfo'; 
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