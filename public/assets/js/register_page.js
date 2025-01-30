document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent actual form submission

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");

    nameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";
    confirmPasswordError.textContent = "";

    let isValid = true;

    if (!name) {
        nameError.textContent = "Full name is required";
        isValid = false;
    }

    if (!email) {
        emailError.textContent = "Email is required";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        emailError.textContent = "Invalid email format";
        isValid = false;
    }

    if (!password) {
        passwordError.textContent = "Password is required";
        isValid = false;
    } else if (password.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters";
        isValid = false;
    }

    if (confirmPassword !== password) {
        confirmPasswordError.textContent = "Passwords do not match";
        isValid = false;
    }

    if (isValid) {
        alert("Registration successful (Simulated)"); // Replace with actual registration logic
        // window.location.href = "login.php"; // Redirect to login
    }
});
