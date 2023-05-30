import {renderShowAllPage} from './templates/showAllTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');

function renderPage() {
    container.innerHTML = renderShowAllPage(mainData);

    const loginButton = document.querySelector('#login-button');
    const matchButton = document.querySelector('#match-button');

    // loginButton.addEventListener('click', onClick);
    // matchButton.addEventListener('click', onMatch);
    onShowAll();
}
let cards = "";

const onShowAll = () => {
    fetch('http://dipa.lan/showProfiles', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: '{}'
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // console.log(data)
            if (data) {
                for ( let profile of data) {
                    console.log(profile);
                    cards += `
                        <div id="card">
                            <h1>Name: ${profile.basic.name}</h1>
                            <h3>Age: ${profile.second.age}</h3>
                            <h3>Location 📍: ${profile.basic.location}</h3>
                            <h3>Budget 💵: ${profile.basic.budget}€</h3>
                            <h3>Gender: ${profile.second.gender == 'male' ? 'Male ♂️' : 'Female ♀️'}</h3>
                            <h3>Pet 🐕: ${profile.second.pet ? 'Yes' : 'No'} </h3>
                            <h3>Smoke 🚬: ${profile.second.smoke ? 'Yes' : 'No'} </h3>
                            <h3>Cleaning 🧼: ${profile.second.housework.clean ? 'Yes' : 'No'} </h3>
                            <h3>Cooking 🍳: ${profile.second.housework.cooking ? 'Yes' : 'No'}</h3>
                        </div>
                    `;
                    document.querySelector('.inside-container').innerHTML = cards;
                }
            } else {
                alert(data.message)
            }
        })
        .catch(error => {
            console.error('Error registering:', error);
        })
}

renderPage();
