
// E V E N T S

// $(document).ready(function() {
    $('#recipes').change(function() {
        var id = this.options[this.selectedIndex].value;
        $('#recipe_id').val(id);
        $('#recipe_selected').val('1');
        $(this).closest('form').submit();
    });

    $('#submit_filter_ing').click(function() {
        $('#filter_ing').val('1');
    });

    $('#submit_filter_cat').click(function() {
        $('#filter_cat').val('1');
    });

    $('#apply_filters_button').click(function() {
        $('#filters').toggleClass('hidden');
    });
// });