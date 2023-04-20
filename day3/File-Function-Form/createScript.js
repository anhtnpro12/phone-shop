let createBtn = document.getElementById('create');
let createForm = document.getElementById('createForm');

let userName = document.getElementById('user-name');
let userNameError = document.getElementById('user-name-error');
let password = document.getElementById('password');
let passwordError = document.getElementById('password-error');

createBtn.addEventListener('click', (e) => {
    let isOk = true;
    if (!userName.value) {
        isOk = false;
        userNameError.style.display = 'block';
    } else {        
        userNameError.style.display = 'none';
    }

    if (!password.value) {
        isOk = false;
        passwordError.style.display = 'block';
    } else {        
        passwordError.style.display = 'none';
    }
    
    createForm.onsubmit = () => isOk;
});