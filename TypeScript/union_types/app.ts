
const stringId = "aba"

const numberId = 123

function printId(id: string | number){
    if (typeof id == "string"){
        console.log(`ID is ${id}`)
    }
    else{
        console.log(`ID is ${id}`)
    }
}

printId(stringId)

printId(numberId)

function move(distance: string | number){
    if (typeof distance == "string"){
        console.log(`Walks to ${distance}`)
    }
    else if(typeof distance == "number"){
        console.log(`Walks ${distance} meter`)
    }
}

move("100")
move(200)