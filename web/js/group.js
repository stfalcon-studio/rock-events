$(function () {
    $('.delete-group').on('click', function () {
        var url = $(this).data('group-slug');
        var $parent = $(this).parent().parent();
        $.ajax({
            url: url,
            dataType: 'JSON',
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
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    console.log('success')
                } else {
                    alert('error');
                }
            }
        })
    });

    $('.delete').on('click', function () {
        var url = $(this).data('bookmark-group-delete');
        var element = this;
        $.ajax({
            url: url,
            success: function (response) {
                if (true === response.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    console.log('success')
                } else {
                    alert('error');
                }
            }
        });
    });
});
