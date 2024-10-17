$(document).ready(function() {
    $('#blogSection-form').on('submit', function(event) {
        event.preventDefault(); 
        var blog_id = $('#blog_id').val();

        $('.error-message').html('');

    
        var formData = {
            blog_id: blog_id,
            order: $('#order').val(),
            section_title: $('#section_title').val(),
            section_content: $('#section_content').val(),

            _token: $('meta[name="csrf-token"]').attr('content') 
        };

            
                $.ajax({
                    url: '/blog/section/create', 
                    type: 'POST', 
                    data: formData, 
                
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                $('#blogSection-form')[0].reset();

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