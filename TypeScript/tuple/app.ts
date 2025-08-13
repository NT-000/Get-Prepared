const coordinates= [12,34]

function printCoordinates(type:number[]) {

    if(type.length == 2){
        console.log("type:", type, "known as a tuple");
    }
    console.log(`X = ${type[0]} - Y = ${type[1]}`);
}

printCoordinates(coordinates);