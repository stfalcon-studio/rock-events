$(function () {
    var $ulElement = $('#event-ul');

    $('input:radio[name=music-style]').change(function () {
        filter($ulElement);
    });

    $('input:radio[name=city]').change(function () {
        filter($ulElement);
    });

    $('input:radio[name=date]').change(function () {
        filter($ulElement);
    });
});

function filter($ulElement) {
    var valGenre = $('input:radio[name=music-style]:checked').val();
    var valCity  = $('input:radio[name=city]:checked').val();
    var valDate  = $('input:radio[name=date]:checked').val();

    $.ajax({
        url: 'main-filters',
        data: {'genre': valGenre, 'city': valCity, 'date': valDate},
        success: function (response) {
            if (true === response.status) {
                $ulElement.children().remove();
                $ulElement.append(response.template);
            }
        }
    });
}

