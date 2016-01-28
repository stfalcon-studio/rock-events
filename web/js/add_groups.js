var $divTable = $('#div_table');
var $addButton = $('#add_button');
var $elementTable;
var $elementBody;

$(function () {
    $addButton.on('click', function (e) {
        e.preventDefault();
        if ($('#groups').length === 0) {
            var prototypeTable = $divTable.data('prototype');
            $divTable.append(prototypeTable);
            $elementTable = $('#groups');
            $elementBody = $('#groups_body');
        }
        addTrTable($elementTable, $elementBody);
    });
});

function addTrTable($elementTable, $elementBody) {
    var prototype = $elementTable.data('prototype');
    var name = $('#selected-group option:selected').text();
    var slug = $('#selected-group option:selected').attr('id');
    var $allTr = $elementBody.children('tr');
    $flagGroup = false;
    $allTr.each(function () {
        if ($(this).attr('id') === slug) {
            alert('Гурт вже доданий');
            $flagGroup = true;
        }
    });
    if ($flagGroup === true) {
        return 0;
    }
    var newElement = prototype.replace(/__name__/g, name).replace(/__slug__/g, slug);
    $elementBody.append(newElement);
}
