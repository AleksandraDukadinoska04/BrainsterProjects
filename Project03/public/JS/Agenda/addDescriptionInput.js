$(document).ready(function() {
  
    $('#add-description-btn').click(function() {
        $('#descriptions-wrapper').append(`
             <div class="description coolinput w-100 p-0">
                <label for="description" class="text">Description</label>
                <input type="text" id="description" name="descriptions[]" class="input " placeholder="Write description...">
                <div class="">
                    <button type="button" class="remove-description  my-2 fst-italic fw-bold">Remove Description<i class="fa-solid fa-trash ms-2"></i></button>
                </div>

            </div>
        `);
    });
});

$(document).on('click', '.remove-description', function() {
    $(this).closest('.description').remove();
});


$('#edit-add-description-btn').click(function() {
    $('#edit-descriptions-wrapper').append(`
         <div class="description coolinput w-100 p-0">
                <label for="description" class="text">Description</label>
                <input type="text" name="descriptions[]"  class="input">

                <div class="">
                    <button type="button" class="remove-edit-description my-2 fst-italic fw-bold">Remove Description<i class="fa-solid fa-trash ms-2"></i></button>
                </div>
            </div>
    `);
});

$(document).on('click', '.remove-edit-description', function() {
    $(this).closest('.description').remove();
});