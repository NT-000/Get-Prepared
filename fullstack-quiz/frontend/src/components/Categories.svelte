<script>
    let {onChange} = $props()

    let categories = $state(['Sport', 'Naturvitenskap', 'Historie', 'Musikk', 'Mat og drikke', 'Kunst og kultur', 'Vitenskap', 'Film', 'Geografi', 'Litteratur', 'Samfunn', 'Astronomi', 'Teknologi', 'Filosofi', 'Miljø'])
    let selectedCategories = $state([])

    let isOpen = $state(false)
    const handleInputChange = () => {
        onChange(selectedCategories)
    }
    const handleToggleCat = () => {
        isOpen = !isOpen;
    }

</script>

<div class="cats" onclick={handleToggleCat}>Kategorier<img src="/fad--open.png"></div>
{#if isOpen}
    <div class="categories-container">
        <div class="categories">
            {#each categories as cat, i (i)}
                <div class="category-item">
                    <input type="checkbox" value={cat} bind:group={selectedCategories}
                           onchange={handleInputChange}
                    />
                    <div class="label_cats">{cat}</div>
                </div>
            {/each}
        </div>
    </div>
{/if}

<style>

    .categories {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px 20px;
        width: 100%;
        max-width: 600px;
    }

    .categories-container {
        background: white;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        padding: 30px;
        gap: 10px;
    }

    .category-item {
        display: flex;
        align-items: center;
    }

    .label_cats {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 6px;
        color: #444;
    }

    .cats {
        font-weight: bolder;
        cursor: pointer;
    }

    .cats img:hover {
        border: #40a9ff;
        cursor: pointer;
        transform: scale(1.2);
    }

    input[type="checkbox"] {
        margin-right: 8px;
        margin-bottom: 10px;

    }

    input[type="checkbox"]:hover {
        transform: scale(1.2);
        background: lightblue;
        box-shadow: 0 4px 14px blue;
    }
</style>