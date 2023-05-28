import {renderOopsPage} from './templates/OopsTemplate.js';

const mainData = JSON.parse(document.getElementById('mainData').textContent);
const container = document.getElementById('container');

function renderPage() {
    container.innerHTML = renderOopsPage(mainData);
}

renderPage();