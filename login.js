document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (event) {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const errorMessage = document.getElementById("error-message");

        // Simple validation checks
        if (username === "" || password === "") {
            errorMessage.textContent = "Both fields are required!";
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (password.length < 6) {
            errorMessage.textContent = "Password must be at least 6 characters!";
            event.preventDefault();
            return;
        }

        errorMessage.textContent = ""; // Clear errors if everything is okay
    });
});
