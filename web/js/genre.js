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
                    console.log('error');
                }
            }
        })
    });

    $('.add').on('click', function () {
        var url = $(this).data('bookmark-genre-add');
        var urlLike = $(this).data('genre-count-like');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    countLike(element, urlLike);
                    console.log('success');
                } else {
                    console.log('error');
                }
            }
        })
    });

    $('.delete').on('click', function () {
        var url = $(this).data('bookmark-genre-delete');
        var urlLike = $(this).data('genre-count-like');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    countLike(element, urlLike);
                    console.log('success')
                } else {
                    console.log('error');
                }
            }
        });
    });
});

function countLike(element, url) {
    $.ajax({
        url: url,
        success: function (url) {
            if (true === url.status) {
                $(element).parent().parent().prev().find('p#count_like').text(url.message);
            } else {
                alert('error');
            }
        }
    });
}
