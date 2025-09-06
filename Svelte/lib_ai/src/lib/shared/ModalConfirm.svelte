<script lang="ts">

    import {Button} from "$components";
    import Icon from "@iconify/svelte";
    import type {Snippet} from "svelte";


    interface ModalProps {
        isOpen: boolean,
        onAnswer?: (answer: "no" | "yes") => void;
        children?: Snippet;
    }

    let {isOpen, onAnswer, children}: ModalProps = $props();


</script>


{#if isOpen}
    <div class="box">
        <div class="dialog">
            <span><Icon icon="material-symbols:not-listed-location" width="40"/></span>
            <p>{@render children()}</p>
            <Button isWarning={true} onclick={() => onAnswer?.("yes")}>Yes</Button>
            <Button onclick={() => onAnswer?.("no")}>Cancel</Button>
        </div>
    </div>
{/if}

<style>
    .box {
        display: flex;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.65);
        align-items: center;
        justify-content: center;
    }

    .dialog {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        min-width: 250px;
        text-align: center;
        margin-bottom: 20px;
        font-style: italic;
        font-weight: bolder;
    }

    p {
        margin-bottom: 20px;
    }

    span {
        display: block;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

</style>