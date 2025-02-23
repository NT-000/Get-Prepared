const http = require('http');
const fs = require('fs');
const _ = require('lodash')
const PORT = 3000;

const server = http.createServer((req, res) => {
    console.log(`Server running at ${new Date()}`);

    //lodash
    const num = _.random(0, 20);
    console.log('Num: ', num);

    const greet = _.once(() => {
        console.log(`Hello, world!`);
    });
    greet();
    greet();


    // set header content-type

    res.setHeader('Content-Type', 'text/html');

    // send html file
    let path = './views/';

    switch (req.url) {
        case '/':
            path += 'index.html';
            res.statusCode = 200;
            break;
        case '/about':
            path += 'about.html';
            res.statusCode = 200;
            break;
        case '/about-me':
            res.statusCode = 301;
            res.setHeader('Location', '/about');
            res.end();
            break;
        default:
            path += '404.html';
            res.statusCode = 404;
            break;

    }


    fs.readFile(path, 'utf8', (err, data) => {
        if (err) {
            console.error(err);
            res.end();
        } else {
            res.write(data);
            res.end();
        }
    })

})


server.listen(PORT, 'localhost', () => {
    console.log(`listening for requests on ${PORT}`);
});