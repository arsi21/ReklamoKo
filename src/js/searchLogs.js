$(document).ready(function () {
    $("#searchInput").keyup(function () {
        let search = $("#searchInput").val();
        $("#dataCont").load("includes/search-logs.php", {
            search: search
        });
    });
});