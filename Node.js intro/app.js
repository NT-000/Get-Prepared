const fs = require('fs');


// 
var readline = require('readline');
var rl = readline.createInterface({
    input: process.stdin, output : process.stdout});

// readfile
// fs.readFile('./notater.json.txt', (err,data) => {
//     if(err) {
//         console.error(err);
//     };
//     console.log(data.toString());
// })

// writefile
// fs.writeFile('./notater.json.txt', 'hello there',() => {
//
//     console.log('File was written!');
// })
//
// fs.writeFile('./notater2.json.txt', 'hello there',() => {
//
//     console.log('File was written!');
// })

// create folder
if(!fs.existsSync('./assets')) {

    fs.mkdir('./assets', (err) => {
        if (err) {
            console.log(err);
        }
        console.log('Folder created!');
    });

}else{
    fs.rmdir('./assets', (err) => {
        if(err){
            console.log(err)
        }
        console.log('Folder removed!');
    })

}

// if(fs.existsSync('./delete.txt')) {
//    
//     fs.unlink('./delete.txt', (err) => {
//         if(err){
//             console.log(err);
//         }
//         console.log('file deleted');
//     })
// }
