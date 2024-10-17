$(document).ready(function() {

    $('#addSection').click(function() {
        const sectionHTML = `
            <div class="section w-100 d-flex flex-wrap align-itemns-start justify-content-between border-bottom pb-3 mb-3">
                    <div class="coolinput">
                        <label for="section_order" class="text">Order:</label>
                        <input type="number" name="order[]" class="section-order input" placeholder="Write order of the section...">
                        <small class="order-error error-message text-danger fw-bold d-block"></small>
                    </div>

                    <div class="coolinput">
                        <label for="section_title" class="text">Section Title:</label>
                        <input type="text" name="section_title[]" class="section-title input" placeholder="Write title of the section...">
                        <small class="section_title-error error-message text-danger fw-bold d-block"></small>
                    </div>


                    <div class="coolinput">
                        <label for="section_body" class="text">Section Body:</label>
                        <textarea name="section_body[]" class="section-body input" placeholder="Write the content of the section..."></textarea>
                        <small class="section_body-error error-message text-danger fw-bold d-block"></small>
                    </div>

                    <div class="coolinput">
                        <button type="button" class="remove-section btn-create my-auto fst-italic fw-bold">Remove Section<i class="fa-solid fa-trash ms-2"></i></button>
                    </div>

                </div>
        `;
        $('#sections').append(sectionHTML);
    });

   
    $(document).on('click', '.remove-section', function() {
        $(this).closest('.section').remove();
    });

});
