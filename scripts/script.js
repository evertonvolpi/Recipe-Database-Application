
// E V E N T S

$('#categories_list').change(function () {
    var catId = this.options[this.selectedIndex].value;
    
    if(catArray.includes(catId)) {
        alert('Already on the categories list');
    } else {
        var catName = this.options[this.selectedIndex].text;

        $('#categories_table').append(`<tr>
        <td>${catName}</td>
        <td><a class="remove_button" href="javascript:void(0)" id="rem_cat_${catId}"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td></tr>`);

        catArray.push(catId);
    }
});

$("#ingredients_list").change(function() {
    var ingId = this.options[this.selectedIndex].value;
    
    if(ingArray.includes(ingId)) {
        alert('Already on the ingredients list');
    } else {
        var ingName = this.options[this.selectedIndex].text;

        $('#ingredients_table').append(`<tr>
        <td>${ingName}</td>
        <td><input type='text' name='${ingId}' /></td>
        <td><a class="remove_button" href="javascript:void(0)" id="rem_cat_${ingId}"><i class="far fa-trash-alt delete_button" title="delete"></i></a></td></tr>`);
        
        ingArray.push(ingId);
    }
});

$('table').on('click', 'a.remove_button', function() {
    var id = this.id.slice(8);
    var group = this.id.slice(4, 7)
    console.log(`Complete id is: ${this.id} | the id itself is: ${id} | the group is ${group}`);
    
    removeItemFromArray(group, id);

    $(this).closest('tr').remove();
})

$('#submit').click(function() {
    listToString(ingArray, 'ing');
    listToString(catArray, 'cat');
});

// F U N C T I O N S

function removeItemFromArray(arrayGroup, item) {
    if(arrayGroup === 'ing') {
        ingArray = $.grep(ingArray, function(value) {
        return value != item;
        })
        ingIdListValue = ingArray.toString();
    } else {
        catArray = $.grep(catArray, function(value) {
        return value != item;
        })
        catIdListValue = catArray.toString();
    }
};

function listToString(list, group) {
    if(group === 'ing') {
        var ingIdListValue = list.toString();
        $('#ing_list').val(ingIdListValue);
    } else {
        var catIdListValue = list.toString();
        $('#cat_list').val(catIdListValue);
    }
}








