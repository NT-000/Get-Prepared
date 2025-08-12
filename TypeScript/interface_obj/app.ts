import {IPerson} from "./IPerson";

const person: IPerson = {
    name: "Jon",
    age: 25,
    interests: ["Reading", "Skiing","Chess"],
}

function showInterests (type:object) {
    console.log(`${person.name}'s interests are: ${person.interests.join(", ")}`);
}

showInterests(person)