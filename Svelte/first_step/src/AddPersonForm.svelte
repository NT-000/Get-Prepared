<script>
    import {createEventDispatcher} from 'svelte';

    const dispatch = createEventDispatcher();

let name;
let beltColor;
let age;
let isPremium = false;
let skills = [];

$: {
    console.log(name, beltColor, age, isPremium);
}
const toggleIsPremium = () => {
    isPremium = !isPremium;
}

const handleSubmit = () => {
    console.log(name, beltColor, age, isPremium, skills);
    const person =
        {
            name: name,
            beltColor: beltColor,
            age: age,
            isPremium: isPremium,
            skills: skills,
            id: Math.random()
        }
        dispatch('addPerson', person);

}
</script>

<main>
    <h3>Add new person</h3>
    <form on:submit|preventDefault={handleSubmit}>
        <input type="text" placeholder="Your Name" bind:value={name}>
        <select bind:value={beltColor}>
            <option>White</option>
            <option>Yellow</option>
            <option>Orange</option>
            <option>Blue</option>
            <option>Brown</option>
            <option>Black</option>
        </select>
        <input type="number" placeholder="Your Age" bind:value={age}>
        <label>Become a premium member?</label><input type="checkbox" bind:checked="{isPremium}">
        <br>
        <label>Skills</label>
        <input type="checkbox" bind:group={skills} value="fighting">Fighting<br>
        <input type="checkbox" bind:group={skills} value="sneaking">Sneaking<br>
        <input type="checkbox" bind:group={skills} value="running">Running<br>
        <button>Add Person</button>
    </form>
</main>

<style>

</style>