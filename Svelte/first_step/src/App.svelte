<script>
import Modal from './Modal.svelte'
import AddPersonForm from './AddPersonForm.svelte'
let showModal = false;
let people = [
    {name:'Joe', beltColor:'White', skills:['Fightning'], isPremium:true, age:32, id:1},
    {name:'Anna', beltColor:'Black', skills:['Sneaking','Running'], isPremium:false, age:22, id:2},
    {name:'Siegfried', beltColor:'Yellow', skills:['Running'], isPremium:true, age:37, id:3},
]

const randomMember = () =>{
    const randomNumber = Math.floor(Math.random() * people.length)
    return people[randomNumber]
}
let loggedInMember = randomMember();

const handleDelete = (id) =>{
    people = people.filter((person) => person.id !== id)
}
const toggleClick = () =>{
    showModal = !showModal
}
const addPerson = (event) =>{
    const person = event.detail
    people = [...people, person]
    showModal = false
}
</script>
<button on:click|once={toggleClick}>
    <span>
    Open modal
</span>
</button>
<Modal on:click={toggleClick} {showModal}>
<AddPersonForm on:addPerson={addPerson}></AddPersonForm>
</Modal>
<main>

<div>
    {#each people as person (person.id)}
    <ul>
            {person.name}
        {#if person.beltColor === 'White'}
            <strong>A MA Joke</strong>
            {:else if person.beltColor === 'Black'}
            <strong>MASTER MA</strong>
            {:else}
            <strong>{person.beltColor} belt, good enough</strong>
        {/if}
        <br>Belt: {person.beltColor}
        <br>Age:{person.age}
        <br>Premium Member:{person.isPremium}
        <br>Skills:<br>
        {#each person.skills as skill (skill.id)}
            {skill},
            {/each}
        <br>
            <button on:click={() => handleDelete(person.id)}>Delete</button>
    </ul>
    {:else}
        <p>There are no people to show...</p>
    {/each}

</div>
</main>

<style>
    main {
        text-align: center;
        padding: 1em;
        max-width: 240px;
        margin: 0 auto;
    }

    h1 {
        color: #ff3e00;
        text-transform: uppercase;
        font-size: 4em;
        font-weight: 100;
    }

    @media (min-width: 640px) {
        main {
            max-width: none;
        }
    }
    </style>