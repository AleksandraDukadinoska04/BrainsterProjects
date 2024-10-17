
$('#blog-form').on('submit', function(e) {
    e.preventDefault();

    
    let formData = new FormData(this);
  
    $.ajax({
        type: 'POST',
        url: '/blogs/create',  
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire(
                    'Created!',
                    response.message,
                    'success'
                ).then(() => {
                    window.location.href = '/blogs'; 
                });
            } else {
                Swal.fire(
                    'Error!',
                    response.message,
                    'error'
                );
            }
        },
        error: function(response) {
       
              $('#title-error').text('');
              $('#img-error').text('');
              $('.order-error').text('');
              $('.section_title-error').text('');
              $('.section_body-error').text('');
  
            if(response.responseJSON.errors){
              let errors = response.responseJSON.errors;

              if (errors.title) {
                  $('#title-error').text(errors.title[0]);
              }
   
              if (errors.img) {
                  $('#img-error').text(errors.img[0]);
              }
  
           
              $('input[name="order[]"]').each(function(index) {
                  if (errors[`order.${index}`]) {
                      $(this).siblings('.order-error').text(errors[`order.${index}`][0]);
                  }
              });
  
              $('input[name="section_title[]"]').each(function(index) {
                  if (errors[`section_title.${index}`]) {
                      $(this).siblings('.section_title-error').text(errors[`section_title.${index}`][0]);
                  }
              });
  
              $('textarea[name="section_body[]"]').each(function(index) {
                  if (errors[`section_body.${index}`]) {
                      $(this).siblings('.section_body-error').text(errors[`section_body.${index}`][0]);
                  }
              });
            }
        }
    });
});