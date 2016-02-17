$(function () {
    $('.delete-group').on('click', function () {
        var url = $(this).data('group-slug');
        var $parent = $(this).parent().parent();
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $parent.remove();
                    console.log('success')
                } else {
                    $('.errors').append('<p>Помилка, при обробці запиту</p>');
                }
            }
        })
    });

    $(document).on('click', '.add', function () {
        var url = $(this).data('bookmark-group-add');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#fans').text(response.post_likes);
                } else {
                    $('.errors').append('<p>Помилка, при обробці запиту</p>');
                }
            }
        })
    });

    $(document).on('click', '.delete', function () {
        var url = $(this).data('bookmark-group-delete');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#fans').text(response.post_likes);
                } else {
                    $('.errors').append('<p>Помилка, при обробці запиту</p>');
                }
            }
        });
    });
});
