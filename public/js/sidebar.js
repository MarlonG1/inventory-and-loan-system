let sidebarState = localStorage.getItem("sidebar");
let pageURL = window.location.href;

document.addEventListener('DOMContentLoaded', function () {
    if (!pageURL.includes("dashboard")) {
        if (sidebarState === "active") {
            $("#sidebar").addClass("active");
        } else {
            $("#sidebar").removeClass("active");
        }

        $("#sidebarCollapse").on("click", function () {
            if ($("#sidebar").hasClass("active")) {
                $("#sidebar").removeClass("active");
                localStorage.setItem("sidebar", "inactive");
            } else {
                $("#sidebar").addClass("active");
                localStorage.setItem("sidebar", "active");
            }
        });
    } else {
        $("#sidebar").addClass("");
    }
});



