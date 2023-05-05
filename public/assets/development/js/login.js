import { renderLoginPage } from './templates/loginTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');



function renderPage() {
    container.innerHTML = renderLoginPage(mainData);

    const login = document.querySelector('#login');
    const register = document.querySelector('#register');
    const loginButton = document.querySelector('#login-button');
    const registerButton = document.querySelector('#register-button');

    loginButton.addEventListener('click', handleLoginSubmit);
    registerButton.addEventListener('click', handleRegisterSubmit);
    login.addEventListener('click', switchToLogin);
    register.addEventListener('click', switchToRegister);
}


const switchToLogin = () => {
    const loginButton = document.querySelector('#login-button');
    const registerButton = document.querySelector('#register-button');

    login.classList.add("selected");
    register.classList.remove("selected");
    loginButton.classList.remove('none');
    registerButton.classList.add('none');
}

const switchToRegister = () => {
    const loginButton = document.querySelector('#login-button');
    const registerButton = document.querySelector('#register-button');

    register.classList.add("selected");
    login.classList.remove("selected");
    registerButton.classList.remove('none');
    loginButton.classList.add('none');
}

const handleLoginSubmit = () => {
    let name = document.querySelector('#username').value;
    let pass = document.querySelector('#password').value;

    console.log(name, pass);

// create the data object to send in the request
    let data = {
        "userName": name,
        "password": pass
    };

// send the fetch request to the API endpoint
    fetch('http://dipa.lan/AuthenticationController/Login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(data.success===true){
                location.replace("http://dipa.lan/search.html")
            }else {
                console.log(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        });
}

const handleRegisterSubmit = () => {
    let name = document.querySelector('#username').value;
    let pass = document.querySelector('#password').value;

    console.log(name, pass);

    // create the data object to send in the request
    let data = {
        "userName": name,
        "password": pass
    };

// send the fetch request to the API endpoint
    fetch('http://dipa.lan/AuthenticationController/Register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if(data.success===true){
                location.replace("http://dipa.lan/search.html%22")
            }else {
                console.log(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        });

}




renderPage();