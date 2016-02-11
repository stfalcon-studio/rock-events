$(function () {
    var $divElement = $('#group-div');

    $('select').change(function () {
        // id input get
        var valGenre   = $('#genre option:selected').val();
        var valCountry = $('#country option:selected').val();
        var valCity    = $('#city option:selected').val();
        var valLike    = $('#like option:selected').val();

        $.ajax({
            url: 'group-filters',
            data: {'genre': valGenre, 'country':valCountry, 'city': valCity, 'like': valLike},
            success: function (response) {
                if (true === response.status) {
                    $divElement.children().remove();
                    $divElement.append(response.template);
                }
            }
        });
    })
});
