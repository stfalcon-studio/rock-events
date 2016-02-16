$(function () {
    $(document).on('click', '.delete-group', function () {
        var url = $(this).data('group-slug');
        var $parent = $(this).parent().parent();
        $(this).prop('disabled', true);
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $parent.remove();
                    console.log('success')
                } else {
                    alert('error');
                }
            }
        })
    });

    $(document).on('click', '.add', function () {
        var url = $(this).data('bookmark-group-add');
        var element = this;
        $(element).prop('disabled', true);
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#fans span').text(response.post_likes);
                    $(element).prop('disabled', false);
                } else {
                    alert('error');
                }
            }
        })
    });

    $(document).on('click', '.delete', function () {
        var url = $(this).data('bookmark-group-delete');
        var element = this;
        $(element).prop('disabled', true);
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    $(element).parent().parent().find('p#fans span').text(response.post_likes);
                    $(element).prop('disabled', false);
                } else {
                    alert('error');
                }
            }
        });
    });
});
