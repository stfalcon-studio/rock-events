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
                    alert('error');
                }
            }
        })
    });

    $('.add').on('click', function () {
        var url = $(this).data('bookmark-group-add');
        var urlLike = $(this).data('group-count-like');
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
                    alert('error');
                }
            }
        })
    });

    $('.delete').on('click', function () {
        var url = $(this).data('bookmark-group-delete');
        var urlLike = $(this).data('group-count-like');
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
                    alert('error');
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
                $(element).parent().next().find('p').text(url.message+' Fans');
            } else {
                alert('error');
            }
        }
    });
}
