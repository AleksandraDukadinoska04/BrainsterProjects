$(document).ready(function() {
    $('#employee-form').on('submit', function(event) {
        event.preventDefault(); 
        
        $('.error-message').html('');

    
        var formData = {
            name: $('#name').val(),
            surname: $('#surname').val(),
            img: $('#img').val(),
            profession: $('#profession').val(),
            bio: $('#bio').val(),
            facebook: $('#facebook').val(),
            instagram: $('#instagram').val(),
            linkedin: $('#linkedin').val(),
            twitter: $('#twitter').val(),


            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/employees/create',
                    type: 'POST',
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = "/employees"; 
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