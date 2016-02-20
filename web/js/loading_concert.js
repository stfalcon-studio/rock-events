$(function () {
    $(document).on('click', '#show_concert', function () {
        var $ulElement = $('#event-ul');
        var count_events = $ulElement.children().length;
        $.ajax({
            url: 'loading-concert',
            data:{ 'count-events': count_events },
            success: function (response) {
                if (true === response.status) {
                    $ulElement.children().remove();
                    $ulElement.append(response.template);
                } else {
                    $('.errors ul').append('<li>Помилка, при обробці запиту</li>');
                }
            }
        })
    });
});
