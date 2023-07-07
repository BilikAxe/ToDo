$(document).on('click', '#createTaskListSubmitBtn', function(event) {
    event.preventDefault();
    var form = $('#createTaskListFormModal')[0];
    var formData = new FormData(form);

    $.ajax({
        url: $(form).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#createTaskListModal').modal('hide');
            location.reload();
        },
        error: function(response) {
            var errors = response.responseJSON.errors;
            if (errors) {
                for (var key in errors) {
                    var input = $(form).find('input[name="' + key + '"], select[name="' + key + '"]');
                    input.addClass('is-invalid');
                    var feedback = input.siblings('.invalid-feedback');
                    if (errors[key][0] === "The " + key + " field is required.") {
                        feedback.text('Это поле обязательно для заполнения.');
                    } else {
                        feedback.text(errors[key][0]);
                    }
                }
            }
        }
    });
});
