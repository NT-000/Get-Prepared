<script>
import Modal from './Modal.svelte'
let showModal = false;
let people = [
    {name:'Joe', beltColor:'White', isPremium:true, age:32, id:1},
    {name:'Anna', beltColor:'Black',isPremium:false, age:22, id:2},
    {name:'Siegfried', beltColor:'Yellow', isPremium:true, age:37, id:3},
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
let num = 3
</script>
<button on:click|once={toggleClick}>
    <span>
    Open modalSS
</span>
</button>
<Modal message="25% off for premium members" regMsg="ATTENTION! New offers for new members!!!" isPremium={loggedInMember.isPremium} {showModal} on:click={toggleClick} {loggedInMember}/>
<main>
    {#if num > 11}
        <p>Number greater than 11</p>
        {:else if num > 6}
        <p>Number is greater than 6</p>
    {:else}
        <p>Not greater than 6</p>
        {/if}

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
        {/if}<br> Belt: {person.beltColor} - {person.age}
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