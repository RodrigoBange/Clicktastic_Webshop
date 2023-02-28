document.getElementById('keywords').onkeyup = function() {searchFilter() };

var filters = "";

// Handles search and filter operations, display the filtered result.
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    const keywords = $('#keywords').val();

    $.ajax({
        type: 'POST',
        url: '/shop/getproducts',
        data: 'page=' + page_num + '&keywords=' + keywords + '&filters=' + filters,
        success: function (html) {
            $('#dataContainer').html(html);
        }
    });
}

// Checks all checkboxes for their values to add to the filter
function checkBoxChanged() {
    filters = "";

    // Get all checked checkboxes and add to filter
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

    for (var i = 0; i < checkboxes.length; i++) {
        filters += checkboxes[i].value + "-";
    }

    // Remove last dash
    filters = filters.slice(0, -1);

    // Filter
    searchFilter();
}