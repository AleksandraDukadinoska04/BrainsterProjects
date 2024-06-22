const approvedFilter = document.querySelector('#approved');
const notApprovedFilter = document.querySelector('#notApproved');
const pendingFilter = document.querySelector('#pending');
const approvedComments = document.querySelectorAll('.approved');
const notApprovedComments = document.querySelectorAll('.notApproved');
const pendingComments = document.querySelectorAll('.pending');



if (approvedFilter !== null && notApprovedFilter !== null && pendingFilter !== null) {


    approvedFilter.addEventListener('change', () => {

        if (approvedFilter.checked) {
            approvedFilter.nextElementSibling.style.display = 'inline-block';
            approvedFilter.previousElementSibling.style.display = 'none';


            approvedComments.forEach(e => {
                e.style.display = 'block';
            })


        } else {
            approvedFilter.nextElementSibling.style.display = 'none';
            approvedFilter.previousElementSibling.style.display = 'inline-block';
            approvedComments.forEach(e => {
                e.style.display = 'none';
            })
        }

    })

    notApprovedFilter.addEventListener('change', () => {

        if (notApprovedFilter.checked) {
            notApprovedFilter.nextElementSibling.style.display = 'inline-block';
            notApprovedFilter.previousElementSibling.style.display = 'none';

            notApprovedComments.forEach(e => {
                e.style.display = 'block';
            })


        } else {
            notApprovedFilter.nextElementSibling.style.display = 'none';
            notApprovedFilter.previousElementSibling.style.display = 'inline-block';

            notApprovedComments.forEach(e => {
                e.style.display = 'none';
            })
        }

    })

    pendingFilter.addEventListener('change', () => {

        if (pendingFilter.checked) {
            pendingFilter.nextElementSibling.style.display = 'inline-block';
            pendingFilter.previousElementSibling.style.display = 'none';

            pendingComments.forEach(e => {
                e.style.display = 'block';
            })


        } else {
            pendingFilter.nextElementSibling.style.display = 'none';
            pendingFilter.previousElementSibling.style.display = 'inline-block';

            pendingComments.forEach(e => {
                e.style.display = 'none';
            })
        }

    })
}