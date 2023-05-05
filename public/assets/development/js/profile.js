import { renderProfilePage } from './templates/profileTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');



function renderPage() {
    container.innerHTML = renderProfilePage(mainData);

    const login = document.querySelector('#login');
    const register = document.querySelector('#register');
    const loginButton = document.querySelector('#login-button');
    const registerButton = document.querySelector('#register-button');

    loginButton.addEventListener('click', handleLoginSubmit);
    registerButton.addEventListener('click', handleRegisterSubmit);
    login.addEventListener('click', switchToLogin);
    register.addEventListener('click', switchToRegister);
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
    fetch('http://dipa.lan/UserDetailsController/CreateProfile', {
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
    let location = document.querySelector('#location').value;
    let budget = document.querySelector('#budget').value;
    let age = document.querySelector('#age').value;
    let male = document.querySelector('#male').checked;
    let female = document.querySelector('#female').checked;
    let pet = document.querySelector('#pet').checked;
    let smoke = document.querySelector('#smoke').checked;
    let cleaning = document.querySelector('#cleaning').checked;
    let cooking = document.querySelector('#cooking').checked;


    // create the data object to send in the request

    let data = {
        "location": location,
        "budget": budget,
        "age": age,
        "male": male,
        "female": female,
        "pet": pet,
        "smoke": smoke,
        "cleaning": cleaning,
        "cooking": cooking
    };

    console.log(data);

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