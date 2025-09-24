<script lang="ts">
    import {type Book, getUserState} from "$lib/state/user-state.svelte";
    import PickRating from "$components/PickRating.svelte";
    import {Button, StarRating} from "$components";
    import Icon from "@iconify/svelte";
    import ModalConfirm from "$lib/shared/ModalConfirm.svelte";
    import {calculateDaysPast} from "$components/helperFunctions/helpers";
    import Dropzone from "svelte-file-dropzone";


    interface BookPageBookProps {
        data: {
            book: Book
        }
    }

    let userContext = getUserState();
    let {data}: BookPageBookProps = $props();
    let book = $derived(data.book)

    let newTitle = $state(data.book.title || "")
    let newAuthor = $state(data.book.author || "");
    let newDescription = $state(data.book.description || "");
    let updatedRating = $state(data.book.rating ?? 0)
    let newGenre = $state(data.book.genre || "")
    let start = $state(data.book.started_reading || "")
    let finished = $state(data.book.finished_read || "")
    let isConfirmed = $state(false)

    let categories = [
        {id: 1, name: "Classic"},
        {id: 2, name: "History"},
        {id: 3, name: "Fantasy"},
        {id: 4, name: "Psychology"},
        {id: 5, name: "Dystopia"},
        {id: 6, name: "Fiction"},
    ];

    async function fetchCategories() {
        const req = fetch("")
    }


    let isEdit = $state(false);

    let bookStatus = $derived(
        book.finished_read || finished ? "Read" : book.started_reading || start ? "Currently reading" : "Not started"
    )

    function updateRating(updatedRating: number) {

        book.rating = updatedRating;
        console.log("updatedrating:", updatedRating);
    }

    function handleCat(cat: string) {
        newGenre = cat;
        console.log("newGenre:", newGenre)
    }

    function getDate() {

        let currentDate = new Date().toISOString();
        if (!book.started_reading && !start) {
            start = currentDate;
            book.started_reading = currentDate;
            console.log("start:", start)
        } else if (!book.finished_read && !finished) {
            finished = currentDate;
            book.finished_read = currentDate;
            console.log("finished:", finished)
        }
    }

    async function updateBook() {

        const updatedBook: Partial<Book> = {
            ...(newTitle && {title: newTitle}),
            ...(newAuthor && {author: newAuthor}),
            ...(newDescription && {description: newDescription}),
            ...(newGenre && {genre: newGenre}),
            ...(start && {started_reading: start}),
            ...(finished && {finished_read: finished}),
            ...(updatedRating != null && {rating: book.rating}),
        };

        console.log("payload:", updatedBook)

        await userContext.updateBook({id: book.id, ...updatedBook})
        isEdit = false
    }

    async function handleAnswer(a: "yes" | "no") {

        if (a === "yes") {
            await userContext.deleteBook(book);
            isConfirmed = false;
            $inspect("Book deleted:", {book})
        } else {
            isConfirmed = false;
        }
    }

    async function handleDrop(e: CustomEvent<any>) {
        const {acceptedFiles} = e.detail;
        if (acceptedFiles.length) {
            const file = acceptedFiles[0] as File;
            await userContext.uploadImageCover(file, book.id)
        }
    }

</script>


{#snippet bookInfo()}
    <section>
        <div class="book-container">
            <div class="book-info mb-m">
                <h2 class="book-title mt-m">{book.title}</h2>
                <p class=" mt-m mb-s semi-bold">by {book.author}</p>
                <h3 class="underline mt-m mb-s semi-bold">Your rating</h3>
                <StarRating {book}/>
                <h3 class="underline mt-m">Description</h3>
                <h4 class="book-description italic mt-m mb-xs semi-bold">{book.description}</h4>
                <h4 class="underline mt-m mb-xs semi-bold">Genre</h4>
                <p>{book.genre}</p>
                <div class="book-cover">
                    {#if book.cover_img}
                        <img src="{book.cover_img}" alt="cover">
                    {:else}
                        {@render bookStatusXDays()}
                        <span class="add-image">
                            <span class="icon-wrapper2">
                              No image available
                                <Icon icon="ic:baseline-no-photography" width="40"></Icon>
                            </span>
                        </span>
                    {/if}

                </div>
            </div>
            <Button onclick={() => isEdit = !isEdit}>
                Edit page
            </Button>
        </div>
    </section>
{/snippet}


{#snippet bookStatusXDays()}
    {#if !book.finished_read || !finished}
        <div class="book-status">   {bookStatus}
            <Icon icon="famicons:eye" width="40"/>
        </div>
    {:else}
        <h4 class="book-status-snippet">{bookStatus}
            {#if book.finished_read}
                in {calculateDaysPast(book)} Days
            {/if}
            <Icon icon="famicons:eye"/>
        </h4>
    {/if}
{/snippet}


{#snippet bookInfoEditMode()}

    <section>
        <h1>EDIT MODE</h1>
        <div class="book-info">
            <p>Title</p>
            <input placeholder={book.title} bind:value={newTitle}/>
            <p>Author</p>
            <input placeholder={book.author} bind:value={newAuthor}/>
            <p>Rating</p>
            {#if book.finished_read}
                <PickRating {book} updateDatabaseRating={(rating) => updateRating(rating)}/>
            {:else}
                <p class="mb-m">You can rate or change the rating of the book after you have read it</p>
            {/if}
            <p>Enter description</p>
            <textarea bind:value={newDescription}
                      class="book-description-edit" placeholder={book.description}></textarea>

            <div class="categories-edit">
                <p>Selected genre:</p>
                <select bind:value={newGenre}>
                    <option disabled>Select genre</option>
                    {#each categories as cat}
                        <option>{cat.name}</option>
                    {/each}
                </select>
            </div>
        </div>

        <div class="book-cover">
            {#if !book.cover_img}

                {@render bookStatusXDays()}

                <Dropzone
                        on:drop={handleDrop}
                        multiple={false} accept="image/*" maxSize={5* 1024 * 1024}
                        containerClasses={"dropzone-cover"}>
                  <span class="add-image">Click or drop image in here
                    <span class="icon-wrapper">
                        <Icon class="icon" icon="bi:camera-fill" width="40"/>
                    </span>
                  </span>
                </Dropzone>

            {:else}
                <img src={book.cover_img} alt=""/>
            {/if}
            <div class="status-book">
                {#if !finished}
                    <div class="btn-status">
                        <Button
                                onclick={() => getDate()}>{book.started_reading || start ? "Mark as read" : "Mark as currently reading"}
                        </Button>
                    </div>
                {:else}
                    <p>You Have Finished This Book!</p>
                    <Icon icon="ic:round-celebration" width="40"></Icon>
                {/if}
            </div>
        </div>

        <Button onclick={() => updateBook()}>
            Save page
        </Button>

        {#if !isConfirmed}
            <Button isWarning={true} onclick={() => isConfirmed = !isConfirmed}>Delete Book
                <Icon icon="material-symbols:delete-outline"></Icon>
            </Button>
        {/if}
        {#if isConfirmed}
            <ModalConfirm isOpen={isConfirmed} onAnswer={handleAnswer}
            >Are You sure you want to delete the book?
            </ModalConfirm>
        {/if}
    </section>

{/snippet}


{#if !isEdit}
    {@render bookInfo()}
{:else}
    {@render bookInfoEditMode()}
{/if}

<style>

    section {
        padding: 50px;
    }

    .btn-status {
        display: flex;
        padding: 10px;
        margin: 50px 20px;
        position: absolute;
        justify-content: space-between;
    }

    .book-status-snippet {
        padding: 10px;
        border-bottom: 5px solid #ccc;
        opacity: 0.6;
    }

    .book-status {
        position: absolute;
        right: 5%;
        top: 20px;
        align-items: center;
        display: flex;
        justify-content: center;
        height: 50px;
        padding: 4px 8px;
        width: 60%;
        gap: 15px;
        background-color: rgb(0, 180, 253, 0.6);
        opacity: 0.6;
        border-radius: 10px;
        color: white;
        font-weight: bold;
    }

    .book-description-edit {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 50%;
        min-height: 50%;
        max-width: 60%;
        max-height: 60%;
    }

    .categories-edit {
        padding: 30px 30px 30px 0;
        width: 70%;
        display: flex;
        gap: 24px;
    }

    .book-info {
        width: 50%;
    }

    .book-description {
        width: 50%;
    }

    .book-cover {
        width: 40%;
        position: absolute;
        left: 30%;
        top: 20%;
        justify-content: center;
        align-items: center;
        height: 650px;
        max-width: 500px;
        margin-left: 200px;
        border: thick solid grey;
        border-radius: 12px;

    }

    .book-cover img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    .icon-wrapper {

        display: inline-flex;
        padding: 5px;
        font-size: 30px;
        transition: transform 0.2s ease, filter 0.2s ease;
    }

    .icon-wrapper2 {
        text-align: center;
        justify-content: center;
    }


    .status-book {
        position: absolute;
        bottom: -10%;
        right: 1%;
        left: 40px;
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .add-image {
        display: flex;
        position: absolute;
        top: 45%;
        left: 12%;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        object-fit: cover;
    }

    .add-image:hover .icon-wrapper {
        transform: scale(1.3);
    }

    .icon-wrapper:hover {
        font-weight: bold;
        transform: scale(1.3);
    }

    textarea {
        display: block;
        justify-content: center;
        align-items: center;
        min-width: 50%;
        min-height: 50%;
        resize: none;
    }

    input {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40%;
        margin-bottom: 10px;
        padding: 10px;
    }

    .underline {
        text-decoration: underline;
        text-decoration-color: grey;
    }

    :global(.dropzone-cover) {
        height: 100% !important;
        border-radius: 15px !important;
        object-fit: cover !important;
        background: transparent !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        cursor: pointer !important;
        border: unset !important;
    }

</style>