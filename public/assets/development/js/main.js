console.log('started');
const controller = new AbortController();
const signal = controller.signal;

async function fetchData(url, signal) {
    try {
        const response = await fetch(url, { signal });
        const data = await response.json();
        console.log(data);
    } catch (error) {
        if (error.name === 'AbortError') {
            console.log('Request was aborted');
        } else {
            console.error('Error occurred', error);
        }
    }
}

fetchData('/data', signal).then(r => {});

// Abort the request after 5 seconds
setTimeout(() => controller.abort(), 5000);