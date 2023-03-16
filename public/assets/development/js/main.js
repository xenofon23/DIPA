
console.log('main.js ready');
import {indexPage, buildPills} from "./tamplates/tamplates.js";

let weatherApp = {
    init: () => {
        const dataElement = document.getElementById('mainData');
        const pageData = JSON.parse(dataElement.innerText);
        let pageContainer = document.getElementById('container');

        if (document.body.id === 'loginpage') {
            pageContainer.insertAdjacentHTML('beforeend', weatherApp.buildLogin(pageData));
            weatherApp.buildLoginJs();
        } else {
            pageContainer.insertAdjacentHTML('beforeend', weatherApp.buildIndex(pageData));
        }
    },

//          >>>>>>>>>Page Building Functions<<<<<<<<<<

    buildLoginJs: () => {
        return buildPills();
    },
    buildIndex: (data) => {
        return indexPage(data);
    },

//          >>>>>>>>>Error/Success Handlers<<<<<<<<<<
    errorHandler(data) {
        weatherApp.postError(data)
        return {
            'status': 'error',
            'message': data
        }
    },
    successHandler(data) {
        return {
            'status': 'success',
            'message': data
        }


}}

weatherApp.init();