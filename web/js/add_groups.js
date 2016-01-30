var $divTable = $('#div_table');
var $addButton = $('#add_button');
var $elementTable;
var $elementBody;

$(function () {
    updateTable();
    $addButton.on('click', function (e) {
        e.preventDefault();
        checkTable();
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
    var $newElement = prototype.replace(/__name__/g, name).replace(/__slug__/g, slug);
    $elementBody.append($newElement);
}

function updateTable() {
    checkTable();
    var prototype = $elementTable.data('prototype');
    var $ulGroups = $('.save-groups li');
    if ($ulGroups.length > 0) {
        $ulGroups.each(function () {
            var name = $(this).text();
            var slug = $(this).attr('id');
            var $newElement = prototype.replace(/__name__/g, name).replace(/__slug__/g, slug);
            $elementBody.append($newElement);
        });
    }
}

function checkTable() {
    if ($('#groups').length === 0) {
        var prototypeTable = $divTable.data('prototype');
        $divTable.append(prototypeTable);
        $elementTable = $('#groups');
        $elementBody = $('#groups_body');
    }
}
