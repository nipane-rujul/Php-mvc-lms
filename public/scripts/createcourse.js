$(document).ready(function() {
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        return decodeURI(results[1]) || 0;
    }
    $('#edit').click(function() {
        var id = $.urlParam('id');
        // Set the form action for Action 1
        $('#courseform').attr('action', `/editCourse?id=${id}`);
        // Submit the form
        $('#courseform').submit();
    });

    $('#create').click(function() {
        // Set the form action for Action 2
        $('#courseform').attr('action', '/CreateCourse');
        // Submit the form
        $('#courseform').submit();
    });
});