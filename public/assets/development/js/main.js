
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

    // TODO: send registration request with formData
}

renderPage();