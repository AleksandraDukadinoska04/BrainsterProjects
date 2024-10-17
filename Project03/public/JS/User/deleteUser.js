$(document).ready(function() {
    $('.delete_user').on('click', function() {
        var userId = $(this).data('id'); 

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/users/' + userId + '/delete',   
                    type: 'DELETE',       
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response) {
                        if (response.success) {
                       
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                         
                            $('#user-' + userId).remove();
                        } else {
                       
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                     
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the user.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});