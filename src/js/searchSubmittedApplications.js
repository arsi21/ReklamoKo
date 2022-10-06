$(document).ready(function () {
    $("#searchInput").keyup(function () {
        let search = $("#searchInput").val();
        $("#dataCont").load("includes/search-submitted-applications.php", {
            search: search
        });
    });
});