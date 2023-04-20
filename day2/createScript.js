let createBtn = document.getElementById('create');
let createForm = document.getElementById('createForm');

let userName = document.getElementById('user-name');
let userNameError = document.getElementById('user-name-error');
let password = document.getElementById('password');
let passwordError = document.getElementById('password-error');
let myName = document.getElementById('name');
let nameError = document.getElementById('name-error');
let age = document.getElementById('age');
let ageError = document.getElementById('age-error');
let ageError2 = document.getElementById('age-error2');
let address = document.getElementById('address');
let addressError = document.getElementById('address-error');

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

    if (!myName.value) {
        isOk = false;
        nameError.style.display = 'block';
    } else {        
        nameError.style.display = 'none';
    }

    if (!age.value) {
        isOk = false;
        ageError.style.display = 'block';
    } else {        
        ageError.style.display = 'none';
    }

    if (isNaN(age.value) || age.value != parseInt(age.value, 10)) {
        isOk = false;
        ageError2.style.display = 'block';
    } else {        
        ageError2.style.display = 'none';
    }

    if (!address.value) {
        isOk = false;
        addressError.style.display = 'block';
    } else {        
        addressError.style.display = 'none';
    }
    createForm.onsubmit = () => false;
});