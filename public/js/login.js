function seePassword() {
    let input = document.getElementById('password');
    let icon_eye = document.getElementById('icon_eye');

    if (input.type === 'password') {
        input.type = 'text';
        icon_eye.classList.remove('fa-eye');
        icon_eye.classList.add('fa-eye-slash');

    } else {
        input.type = 'password';
        icon_eye.classList.remove('fa-eye-slash');
        icon_eye.classList.add('fa-eye');
    }
}