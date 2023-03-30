
import { renderLoginForm, renderRegistrationForm } from './templates/templates.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);

const container = document.getElementById('container');

function renderPage() {
    container.innerHTML = renderLoginForm(mainData);

    const loginForm = document.querySelector('form');
    loginForm.addEventListener('submit', handleLoginSubmit);

    const registerLink = document.createElement('a');
    registerLink.textContent = mainData.a2;
    registerLink.href = '#';
    registerLink.addEventListener('click', handleRegisterClick);

    container.appendChild(registerLink);
}

function handleLoginSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    // location.replace("http://message.lan/search.html")
    // TODO: send login request with formData
}

function handleRegisterClick(event) {
    event.preventDefault();

    container.innerHTML = renderRegistrationForm(mainData);

    const registrationForm = document.querySelector('form');
    registrationForm.addEventListener('submit', handleRegistrationSubmit);
}

function handleRegistrationSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    let name = formData.get('name');
    let pass = formData.get('password');

// create the data object to send in the request
    let data = {
        "userName": name,
        "password": pass
    };

// send the fetch request to the API endpoint
    fetch('http://message.lan/AuthenticationController/Register', {
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
            location.replace("http://message.lan/search.html")
        }else {
                console.log(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        });
}

renderPage();