$(document).ready(function() {
    $('#user-form').on('submit', function(event) {
        event.preventDefault(); 

        $('.error-message').html('');

        var not_target_pref = [];
        $('input[name="not_target_pref[]"]:checked').each(function() {
            not_target_pref.push($(this).val());
        });

        var not_topic_pref = [];
        $('input[name="not_topic_pref[]"]:checked').each(function() {
            not_topic_pref.push($(this).val());
        });

        console.log(not_topic_pref)


        let formData = new FormData();
        let pdfFile = $('#CV')[0].files[0];
        let photo = $('#photo')[0].files[0];
        formData.append('name', $('#name').val());
        formData.append('surname', $('#surname').val());
        formData.append('bio', $('#bio').val());
        formData.append('profession', $('#profession').val());
        formData.append('phone', $('#phone').val());
        formData.append('city', $('#city').val());
        formData.append('country', $('#country').val());
        if (pdfFile) {
            formData.append('CV', pdfFile);
        }
        if (photo) {
            formData.append('photo', photo);
        }
        if (not_target_pref.length !== 0) {
            formData.append('not_target_pref', JSON.stringify(not_target_pref));
        }
        if (not_topic_pref.length !== 0) {
            formData.append('not_topic_pref', JSON.stringify(not_topic_pref));
        }
        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            
                $.ajax({
                    url: '/users/create', 
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
                                'Created!',
                                response.message,
                                'success'
                            ).then(() => {
                                window.location.href = '/users'; 
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