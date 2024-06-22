const filters = document.querySelectorAll('.categoryFilter');
const bookCards = document.querySelectorAll('.bookCard');
const labels = document.querySelectorAll('.filterLabel');


filters.forEach(filter => {
  filter.previousElementSibling.style.color = '#980202';
  filter.addEventListener('change', () => {

    if (filter.checked) {
      filter.previousElementSibling.style.color = '#980202';
      filter.nextElementSibling.style.display = 'block';

      bookCards.forEach(card => {
        if (filter.id === card.id) {
          card.style.display = 'block';
        }
      })

    } else {

      filter.previousElementSibling.style.color = 'white';
      filter.nextElementSibling.style.display = 'none';

      bookCards.forEach(card => {
        if (filter.id === card.id) {
          card.style.display = 'none';

        }
      })

    }
  })
})

labels.forEach(e => {
  e.addEventListener('mouseover', () => {
    if (e.nextElementSibling.checked) {
      e.style.color = 'white';
    } else {
      e.style.color = '#980202';
    }

  })
})
labels.forEach(e => {
  e.addEventListener('mouseout', () => {
    if (e.nextElementSibling.checked) {
      e.style.color = '#980202';
    } else {
      e.style.color = 'white';
    }

  })
})