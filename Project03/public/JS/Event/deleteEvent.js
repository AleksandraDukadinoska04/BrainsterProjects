$(document).ready(function() {
    $('.delete_event').on('click', function() {
        var eventId = $(this).data('id'); 

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
                    url: '/events/' + eventId + '/delete',   
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
                         
                            $('#event-' + eventId).remove();
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
                            'An error occurred while deleting the event.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});