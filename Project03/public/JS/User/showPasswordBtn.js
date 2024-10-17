function togglePasswordVisibility1() {
    var passwordInput = document.getElementById("password");
    var toggleIcon1 = document.getElementById("toggle-icon1");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon1.classList.remove("fa-eye-slash");
        toggleIcon1.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        toggleIcon1.classList.remove("fa-eye");
        toggleIcon1.classList.add("fa-eye-slash");
    }
}

function togglePasswordVisibility2() {
    var passwordInput2 = document.getElementsByClassName("password_confirmation");
    var toggleIcon2 = document.getElementById("toggle-icon2");

    if (passwordInput2[0].type === "password") {
        passwordInput2[0].type = "text";
        toggleIcon2.classList.remove("fa-eye-slash");
        toggleIcon2.classList.add("fa-eye");
    } else {
        passwordInput2[0].type = "password";
        toggleIcon2.classList.remove("fa-eye");
        toggleIcon2.classList.add("fa-eye-slash");
    }
}