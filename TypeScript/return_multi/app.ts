
function doubleNumber(numbers:number[]){
    return numbers.map(num => num * 2)

}

console.log(doubleNumber([1, 2, 3]));


function minusNumber(numbers:number[]){
    return numbers.map(num => num - 1)
}

console.log(minusNumber([1, 2, 3]));


const myMap: Map<string, number> = new Map();
myMap.set("orange", 1);
myMap.set("banana", 2);

console.log(myMap.get("banana"));
console.log(myMap.has("orange"));
console.log(myMap.get("orange"));