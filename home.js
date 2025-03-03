document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.getElementById("search-btn");

    searchButton.addEventListener("click", function () {
        alert("Search functionality coming soon!");
    });

    const applyButtons = document.querySelectorAll(".apply-btn");
    applyButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("Application submitted!");
        });
    });
});
