document.addEventListener('DOMContentLoaded', function () {

    const toggleButtons = document.querySelectorAll('.toggle-replies-btn');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            const repliesDiv = document.getElementById('replies-' + commentId);
            const icon = this.querySelector('i');
            
            if (repliesDiv.style.display === 'none' || repliesDiv.style.display === '') {
                repliesDiv.style.display = 'block';
                this.prepend(icon);
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
            } else {
                repliesDiv.style.display = 'none';
                this.prepend(icon);
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
            }
        });
    });
});