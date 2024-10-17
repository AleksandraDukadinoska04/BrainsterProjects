document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('input[name="speaker-filter"]');
    const speakerItems = document.querySelectorAll('.speaker-item');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {
            const selectedType = this.value;

            speakerItems.forEach(item => {
                if (selectedType === 'all') {
                    item.style.display = 'block';
                } else if (item.getAttribute('data-type') === selectedType) {
                    item.style.display = 'block'; 
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    if (radioButtons.length > 0) {
        radioButtons[0].checked = true;
        radioButtons[0].dispatchEvent(new Event('change'));
    }
});