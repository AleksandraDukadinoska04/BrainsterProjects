
const deleteBtn = document.querySelectorAll('#deleteBtn');

deleteBtn.forEach(btn => {

    btn.addEventListener('click', (e) => {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Deleting this book will also delete all of its comments and user notes!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "The book and all of its comments and notes have been deleted.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {

                        btn.parentElement.submit();
                    }
                });


            }
        });
    })
})