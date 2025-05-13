<script>
import {fade} from "svelte/transition";
</script>

<header>
<h1 in:fade>
    <img src="/header.png" alt="logo-header">
</h1>
</header>

<style>
    img{
        max-width: 280px;
        max-height: 200px;
    }
    header{
        background-color: #f7f7f7;
        padding: 20px;
        top: 0;
        border-bottom: 5px solid black;
        border-radius: 10px;
    }
    h1{
    margin: 0;
        padding: 20px;
        text-align: center;
    }
</style>