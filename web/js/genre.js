$(function () {
    $(document).on('click', '.delete-genre', function () {
        var url = $(this).data('genre-slug');
        var $parent = $(this).parent().parent();
        $(this).prop('disabled', true);
        $.ajax({
            url: url, success: function (response) {
                if (true === response.status) {
                    $parent.remove();
                    console.log('success')
                } else {
                    console.log('error');
                }
            }
        })
    });

    $(document).on('click', '.add', function () {
        var url = $(this).data('bookmark-genre-add');
        var element = this;
        $(element).prop('disabled', true);
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#count_like').text(response.post_likes);
                    $(element).prop('disabled', false);
                } else {
                    console.log('error');
                }
            }
        })
    });

    $(document).on('click', '.delete', function () {
        var url = $(this).data('bookmark-genre-delete');
        var element = this;
        $(element).prop('disabled', true);
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#count_like').text(response.post_likes);
                    $(element).prop('disabled', false);
                } else {
                    console.log('error');
                }
            }
        });
    });
});

