function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePassword');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePasswordIcon.classList.toggle('fa-eye-slash');
}

function togglePasswordVisibilityConfirmation() {
    const passwordInput = document.getElementById('password_confirmation');
    const togglePasswordIcon = document.getElementById('togglePasswordConfirmation');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePasswordIcon.classList.toggle('fa-eye-slash');
}