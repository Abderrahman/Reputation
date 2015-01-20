$(document).ready(function() {
    $('#myStat').circliful();

});

$('select').on('change', function() {
    
    s = document.getElementsByName('query')[0].value;
    $.post('Dashboard/query', {'id': s}, function() {
        window.location.replace("dashboard");
    });
});