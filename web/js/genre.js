$(function () {
    $('.delete-genre').on('click', function () {
        var url = $(this).data('genre-slug');
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

    $('.add').on('click', function () {
        var url = $(this).data('bookmark-genre-add');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#count_like').text(response.post_likes);
                    console.log('success');
                } else {
                    $('.errors').append('<p>Помилка, при обробці запиту</p>');
                }
            }
        })
    });

    $('.delete').on('click', function () {
        var url = $(this).data('bookmark-genre-delete');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#count_like').text(response.post_likes);
                    console.log('success')
                } else {
                    $('.errors').append('<p>Помилка, при обробці запиту</p>');
                }
            }
        });
    });
});

