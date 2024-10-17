
$(document).ready(function() {
    $('#edit-blogSection-form').on('submit', function(event) {
        event.preventDefault();
        
        var sectionId = $(this).data('id'); 
        $('.error-message').html(''); 

        let formData = new FormData(this); 
        formData.append('_token', $('meta[name="csrf-token"]').attr('content')); 
        formData.append('_method', 'PUT'); 


        Swal.fire({ 
            title: 'Are you sure?',
            text: "You are about to update this section!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/blog/section/' + sectionId + '/edit', 
                    type: 'POST', 
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
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
                            $.each(errors, function(key, value) {
                                $("#" + key + "-error").text(value[0]); 
                            });
                        }
                    }
                });
            }
        });
    });
});