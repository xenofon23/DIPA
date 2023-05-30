import {renderProfilePage} from './templates/profileTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');

function renderPage() {
    container.innerHTML = renderProfilePage(mainData);
    // console.log(mainData)

    const loginButton = document.querySelector('#login-button');

    if (loginButton.innerHTML === 'Submit') {
        loginButton.addEventListener('click', onSubmit);
    }else {
        loginButton.addEventListener('click', onUpdate);
    }
}

const onSubmit = () => {
    let name = document.querySelector('#full-name').value;
    let location = document.querySelector('#location').value;
    let budget = document.querySelector('#budget').value;
    let age = document.querySelector('#age').value;
    let male = document.querySelector('#male').checked;
    let pet = document.querySelector('#pet').checked;
    let smoke = document.querySelector('#smoke').checked;
    let cleaning = document.querySelector('#cleaning').checked;
    let cooking = document.querySelector('#cooking').checked;

    let gender = male ? 'male' : 'female'

    let data = {
        "basic": {
            "name": name,
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
            }
        }
    }

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
            if (data.success === true) {
                location.replace("http://dipa.lan/matchProfiles.html")
            } else {
                alert(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        });
}

const onUpdate = () => {
    let name = document.querySelector('#full-name').value;
    let location = document.querySelector('#location').value;
    let budget = document.querySelector('#budget').value;
    let age = document.querySelector('#age').value;
    let male = document.querySelector('#male').checked;
    let pet = document.querySelector('#pet').checked;
    let smoke = document.querySelector('#smoke').checked;
    let cleaning = document.querySelector('#cleaning').checked;
    let cooking = document.querySelector('#cooking').checked;

    let gender = male ? 'male' : 'female'

    let data = {
        "basic": {
            "name": name,
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
            }
        }
    }

// send the fetch request to the API endpoint
    fetch('http://dipa.lan/UserDetailsController/UpdateProfile', {
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
            if (data.success === true) {
                location.replace("http://dipa.lan/search.html")
            } else {
                alert(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        });
}

// const onMatch = () => {
//     fetch('http://dipa.lan/match', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//
//             return response.json();
//         }).then( data => {
//         console.log(data.message[0]);
//     })
// }

renderPage();