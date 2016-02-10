$(function () {
    var $ulElement = $('#event-ul');

    $('select').change(function () {
        var valGenre = $('#genre option:selected').val();
        var valCity = $('#city option:selected').val();
        var valDate = $('#time option:selected').val();

        $.ajax({
            url: 'concert-filters',
            data: {'genre': valGenre, 'city': valCity, 'date': valDate},
            success: function (response) {
                if (true === response.status) {
                    $ulElement.children().remove();
                    $ulElement.append(response.template);
                }
            }
        });
    })
});
