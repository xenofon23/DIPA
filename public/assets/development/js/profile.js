import { renderProfilePage } from './templates/profileTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');



function renderPage() {
    container.innerHTML = renderProfilePage(mainData);

    const loginButton = document.querySelector('#login-button');

    loginButton.addEventListener('click', onClick);
}


const onClick = () => {
    let location = document.querySelector('#location').value;
    let budget = document.querySelector('#budget').value;
    let age = document.querySelector('#age').value;
    let male = document.querySelector('#male').checked;
    // let female = document.querySelector('#female').checked;
    let pet = document.querySelector('#pet').checked;
    let smoke = document.querySelector('#smoke').checked;
    let cleaning = document.querySelector('#cleaning').checked;
    let cooking = document.querySelector('#cooking').checked;


    let gender = male ? 'male' : 'female'

    let data = {
        "basic": {
            "location": location,
            "budget": budget
        },
        "second": {
            "pet": pet,
            "age": age,
            "smoke": smoke,
            "gender": gender,
            "housework": {
                "clean": cleaning,
                "cooking": cooking
            }}}


    console.log(data);



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




renderPage();