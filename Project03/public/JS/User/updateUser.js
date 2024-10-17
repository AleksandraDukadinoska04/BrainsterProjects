
$(document).ready(function() {
    $('#edit-user-form').on('submit', function(event) {
        event.preventDefault();

        var userId = $(this).data('id');
        $('.error-message').html('');

        var not_target_pref = [];
        $('input[name="not_target_pref[]"]:checked').each(function() {
            not_target_pref.push($(this).val());
        });

        var not_topic_pref = [];
        $('input[name="not_topic_pref[]"]:checked').each(function() {
            not_topic_pref.push($(this).val());
        });

        console.log($('#password').val())

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

        if (not_topic_pref.length !== 0) {
            formData.append('not_topic_pref', JSON.stringify(not_topic_pref));
        } else {
            formData.append('not_topic_pref', null);
        }
        if (not_target_pref.length !== 0) {
            formData.append('not_target_pref', JSON.stringify(not_target_pref));
        } else {
            formData.append('not_target_pref', null);
        }

        formData.append('email', $('#email').val());
        formData.append('password', $('#password').val());

        formData.append('_method', 'PUT');

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

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
                    url: '/users/' + userId + '/edit',
                    type: 'POST', 
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
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