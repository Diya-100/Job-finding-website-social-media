document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");

    registerForm.addEventListener("submit", function (event) {
        const username = document.getElementById("username").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const role = document.getElementById("role").value;
        
        if (username === "" || email === "" || password === "" || role === "") {
            alert("All fields are required!");
            event.preventDefault();
            return;
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            event.preventDefault();
            return;
        }
    });
});
