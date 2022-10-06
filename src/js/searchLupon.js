$(document).ready(function () {
    $("#searchInput").keyup(function () {
        let search = $("#searchInput").val();
        $("#dataCont").load("includes/search-lupon.php", {
            search: search
        });
    });
});