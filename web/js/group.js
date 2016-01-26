$(function () {
    $('.delete').on('click', function () {
        var url = $(this).data('group-slug');
        var $parent = $(this).parent().parent();
        $.ajax({
            url: url,
            dataType: 'JSON',
            success: function (data, textStatus, xhr) {
                if (204 === xhr.status) {
                    $parent.remove();
                    console.log('success')
                } else {
                    console.log('error');
                }
            }
        })
    });

    $('.amend-plus').on('click', function () {
        var url = $(this).data('group-path');
        var element = this;
        $.ajax({
            url: url,
            dataType: 'JSON',
            success: function (data, textStatus, xhr) {
                if (201 === xhr.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    console.log('success');
                } else {
                    console.log('error');
                }
            }
        })
    });

    $('.amend-minus').on('click', function () {
        var url = $(this).data('group-path');
        var element = this;
        $.ajax({
            url: url,
            dateType: 'JSON',
            success: function (data, textStatus, xhr) {
                if (204 === xhr.status) {
                    $(element).siblings().show();
                    $(element).hide();
                    console.log('success')
                } else {
                    console.log('error');
                }
            }
        });
    });
});
