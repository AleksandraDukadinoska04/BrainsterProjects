$(document).ready(function() {
    $('#speaker-form').on('submit', function(event) {
        event.preventDefault(); 

        $('.error-message').html('');


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

            
                $.ajax({
                    url: '/speakers/create', 
                    type: 'POST', 
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = "/speakers"; 
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