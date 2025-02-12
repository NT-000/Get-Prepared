const fs = require('fs');

// const readstream = fs.createReadStream('./ManyNotes.txt');
const readstream = fs.createReadStream('./blog2.txt', {encoding: 'utf8'});

const writeStream = fs.createWriteStream('./blog4.txt', {encoding: 'utf8'});

const text = 'Hei på deg!';

// readstream.on('data', (chunk) => {
//     console.log('Received new chunk: ',chunk);
// })

// readstream.on('data', (chunk) => {
//     console.log('------------NEW CHUNK --------------------');
//     console.log(chunk);
//     writeStream.write('\n NEW CHUNK\n');
//     writeStream.write(chunk);
//    
// })

// piping

readstream.pipe(writeStream);