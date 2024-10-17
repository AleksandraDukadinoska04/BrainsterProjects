document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const agendaItems = document.querySelectorAll('.agenda-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const selectedDay = this.getAttribute('data-day');

            // Remove 'active' class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('color-darkorange'));
            filterButtons.forEach(btn => btn.classList.add('color-gray'));


            // Add 'active' class to the clicked button
            this.classList.remove('color-gray');
            this.classList.add('color-darkorange');

            // Hide all agenda items
            agendaItems.forEach(item => {
                item.style.display = 'none';
            });

            // Show agenda items for the selected day
            agendaItems.forEach(item => {
                if (item.getAttribute('data-day') === selectedDay) {
                    item.style.display = 'flex';
                }
            });
        });
    });

    // Optional: Show the first day's agenda by default and set the first button as active
    if (filterButtons.length > 0) {
        filterButtons[0].click();
    }
});