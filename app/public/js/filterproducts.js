document.getElementById('keywords').onkeyup = function() {searchFilter() };

// Handles search and filter operations, display the filtered result.
function searchFilter() {
    var page_num = page_num ? page_num : 0;
    const keywords = $('#keywords').val();
    const filterBy = $('#filterBy').val();

    $.ajax({
        type: 'POST',
        url: '/shop/getproducts',
        data: 'page=' + page_num + '&keywords=' + keywords + '&filerBy=' + filterBy,
        success: function (html) {
            $('#dataContainer').html(html);
        }
    });
}