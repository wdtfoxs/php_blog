$(document).on('click', '.dev_comment', function () {
    $('input[name="parent_id"]').val($(this).attr('comment-id'));
    $('.form-control ').attr('placeholder', 'Answer to ' + $(this).attr('comment-name'));
});