
$(document).ready(function() {
    $('#edit-employee-form').on('submit', function(event) {
        event.preventDefault(); 
        
        var employeeId = $(this).data('id');

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
                    url: '/employees/' + employeeId + '/edit', 
                    type: 'PUT', 
                    data: formData, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            ).then(() => {
        
                                window.location.href = '/employees'; 
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