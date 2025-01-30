$(document).ready(function() {
    $('#searchBy').on('change', function() {
        searchBy = $(this).find(':selected').data('searchby');
        $('#search').attr('placeholder', 'Search by ' + searchBy);
    })
})