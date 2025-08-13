type shopStorage = Record<string, number>

const storage: shopStorage = {
    apple: 22,
    banana: 32,
    peach: 32,
    carrot:23,
    strawberry: 32,
};

type Fruits = keyof typeof storage;

function printFruits(store: shopStorage) {
   let total : number = 0;
    for (const item in store) {
        const quantity = store[item as Fruits];
        console.log(`${item}: ${quantity}`);
        total += quantity;
    }
    console.log("Total: ", total);
}

console.log("Storage:",storage);

printFruits(storage);
