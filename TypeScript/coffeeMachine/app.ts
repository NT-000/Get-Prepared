import {CoffeeType} from "./CoffeeType";
import * as readline from "readline";


const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});


function orderCoffee():void{

    console.log(`1) ${CoffeeType[CoffeeType.Espresso]}`);
    console.log(`2) ${CoffeeType[CoffeeType.Americano]}`);
    console.log(`3) ${CoffeeType[CoffeeType.Latte]}`);

    rl.question("Coffee to order:?", (input) => {

        const choice = Number(input);

        if(choice >= 1 && choice <= 3){
            console.log(`You ordered ${CoffeeType[choice]}`);
        }
        else {
            console.log("Something went wrong");
        }
            rl.close();
    })


}

orderCoffee();