

const nic = {name: "Nicolai", age: 32, gender: "male"}

const other = {nationality: "Norwegian", language: "Norwegian", city: "Moss"};

const job = {job:"Developer"}

function merge<T extends object, U extends object>(a: T, b: U): T & U {
    return {...a,...b}
}

const person = merge(nic,other)

const personWithJob = merge(person,job)

console.log(person)
console.log(personWithJob)

const maria = {name:"Maria", age:28, gender:"female"}

const nicMaria = merge(nic,maria)

console.log(nicMaria)