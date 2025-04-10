document.addEventListener("DOMContentLoaded", function () {
    // Get modal elements
    const editProfileModal = document.getElementById("edit-profile-modal");
    const resetPasswordModal = document.getElementById("reset-password-modal");
    const closeButtons = document.querySelectorAll(".close");

    // Open modals
    document.getElementById("edit-profile-btn").addEventListener("click", () => {
        editProfileModal.style.display = "block";
    });

    document.getElementById("reset-password-btn").addEventListener("click", () => {
        resetPasswordModal.style.display = "block";
    });

    // Close modals
    closeButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            editProfileModal.style.display = "none";
            resetPasswordModal.style.display = "none";
        });
    });

    // Edit Profile AJAX
    document.getElementById("edit-profile-form").addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("update_profile.php", {
            method: "POST",
            body: formData
        }).then(response => response.text()).then(data => {
            alert(data);
            location.reload();
        });
    });

    // Reset Password AJAX
    document.getElementById("reset-password-form").addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("reset_password.php", {
            method: "POST",
            body: formData
        }).then(response => response.text()).then(data => {
            alert(data);
            resetPasswordModal.style.display = "none";
        });
    });
});
