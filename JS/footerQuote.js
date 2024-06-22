const footerQuote = $('#footer');

$.get(`https://api.quotable.io/random`, function(data) {

    footerQuote.html(`~<i class='text-white'>${data.content}</i>~ <br> <b>${data.author}</b>`);

  }).fail(function(err) {
    console.log(err);
  })