
bookCards.forEach(e => {
    e.addEventListener('mouseover', () => {
      e.children[1].classList.add('animate__animated');
      e.children[1].classList.add('animate__fadeInDown');

      e.children[1].style.display = 'flex';

    })

    e.addEventListener('mouseout', () => {
      e.children[1].style.display = 'none';

    })


  })