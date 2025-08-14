type Fruits = "apple" | "banana" | "peach" | "strawberry" | "carrot";
type shopStorage = Record<Fruits, number>

const storage: shopStorage = {
    apple: 22,
    banana: 32,
    peach: 32,
    strawberry: 32,
    carrot:23,
};



function printFruits(store: shopStorage) {
   let total : number = 0;
    for (const item in store) {
        const quantity = store[item as Fruits];
        console.log(`${item}: ${quantity}`);
        total += quantity;
    }
    console.log("Total: ", total);
}

printFruits(storage);
