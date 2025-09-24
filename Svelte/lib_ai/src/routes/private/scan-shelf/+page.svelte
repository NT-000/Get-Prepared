<script lang="ts">
    import Dropzone from "svelte-file-dropzone";
    import Icon from "@iconify/svelte";
    import {convertFileToBase64} from "$lib/utils/openai-helpers";
    import {Button} from "$components";
    import {type OpenAiBook, getUserState, type Book} from "$lib/state/user-state.svelte";
    import {goto} from "$app/navigation";
    import ModalConfirm from "$lib/shared/ModalConfirm.svelte";
    import LoadingSpinner from "$lib/shared/LoadingSpinner.svelte";


    let userContext = getUserState();
    let isLoading = $state(false)

    let isConfirmed = $state(false)

    let errorMessage = $state("")

    let uploadedBooks = $state<Book[]>([]);

    let newBooks = $state<Book[]>([])

    let isBooksAddedSuccessfully = $state(false)

    function removeBook(index: number) {
        newBooks.splice(index, 1)
    }

    async function handleDrop(e: CustomEvent<any>) {
        const {acceptedFiles} = e.detail;

        if (acceptedFiles.length) {
            isLoading = true;
            const fileToSendToOpenAi = acceptedFiles[0];

            const base64String = await convertFileToBase64(fileToSendToOpenAi)

            try {
                const response = await fetch("/api/scan-shelf", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({base64: base64String})
                });

                isLoading = false;
                const result = (await response.json()) as { booksEditedFromApi: Book[] };

                uploadedBooks = result.booksEditedFromApi;
                newBooks = uploadedBooks.filter(book => !userContext.userBooks.some(uBook => uBook.title === book.title))

                $inspect("uploadedBooks:", uploadedBooks)
            } catch (error) {
                errorMessage = "Error while uploading file."
            }
        } else {
            errorMessage = `Could not upload file. Are you sure the file size is smaller than 10MB?`
        }
    }

    async function handleAnswer(a: "yes" | "no") {

        if (a === "yes") {
            isLoading = true
            try {
                await userContext.addBooksToLibrary(uploadedBooks);
                isBooksAddedSuccessfully = true
                isConfirmed = false;
            } catch (error: any) {
                errorMessage = error.message;
            }
        } else {
            isConfirmed = false;
        }
    }
</script>

<section>
    <h3 style="font-size: 50px">Take a picture to add new books</h3>
    {#if newBooks.length === 0}
        <div class="upload-area">
            <div class="upload-container">
                {#if errorMessage}
                    <p class="text-center mb-s upload-error">{errorMessage}</p>
                {/if}
                {#if isLoading}
                    <div class="loading-spinner">
                        <LoadingSpinner>Analyzing uploaded image...</LoadingSpinner>
                    </div>
                {:else}
                    <Dropzone
                            on:drop={handleDrop}
                            multiple={false}
                            accept="image/*" maxSize={10* 1024 * 1024}
                            containerClasses={"dropzone-cover"}>
                        <Icon class="icon" icon="bi:camera-fill" width="40"/>
                        <p>Drag a picture here or select a file</p>
                    </Dropzone>
                {/if}
            </div>
        </div>
    {:else if !isBooksAddedSuccessfully}
        <div class="uploaded-book-container">
            <table class="upload-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Genre</th>
                </tr>
                </thead>
                <tbody>
                {#each newBooks as book, i}
                    <tr>
                        <td>{book?.title}</td>
                        <td>{book?.author}</td>
                        <td>{book?.description}</td>
                        <td>{book?.genre}</td>
                        <td>{book?.cover_img ? "Yes" : "No"}</td>
                        <td>
                            <button onclick={() => removeBook(i)}>
                                <Icon icon="streamline:delete-1-solid" width="24" color="red"/>
                            </button>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </table>
            {#if !isConfirmed}
                <Button onclick={() => isConfirmed = !isConfirmed}>Add books</Button>
            {:else}
                {#if isConfirmed}
                    <ModalConfirm isOpen={isConfirmed} onAnswer={handleAnswer}
                    >{uploadedBooks.length === 1 ? "Are you sure you want to add this book?" : "Are you sure you want to add these books?"}</ModalConfirm>
                {/if}
            {/if}
        </div>
    {:else}
        <h4>The selected {uploadedBooks.length} books have been added to your library.</h4>
        <div class="mt-m italic">
            <Button onclick={() => goto("/dashboard")}>Go Back To Library</Button>
        </div>
    {/if}
</section>

<style>

    .upload-area {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .upload-container {
        width: 600px;
        height: 600px;
        border: 1px solid black;
        background: lightgray;
        border-radius: 15px;
        overflow: hidden;
    }

    .upload-table {
        width: 100%;
        background-color: white;
        border-radius: 10px;
        border-collapse: collapse;
    }

    .upload-table thead {
        font-weight: bold;
        font-size: 22px;
        text-align: center;
        border-bottom: 3px solid black;
    }

    .upload-table td {
        padding: 12px;
        border-bottom: 1px solid lightgray;
        font-size: 22px;
        text-align: center;
    }

    .upload-table tr:last-child td {
        border-bottom: none;
    }

    .upload-error {
        color: red;

    }

    .loading-spinner {
        display: flex;
        align-items: center;
        justify-content: center;
        inset: 0;
        z-index: 2;
    }
    

    :global(.dropzone-cover) {
        display: flex;
        min-width: 600px !important;
        min-height: 400px !important;
        height: 100%;
        justify-content: center;
        flex: 0 !important;
    }

    :global(.dropzone-cover):hover {
        scale: 1.2;
        color: black !important;
        font-weight: bold;
        cursor: pointer;
    }


    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }


</style>

