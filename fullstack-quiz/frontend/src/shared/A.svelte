<script>

    const {href, text, emoji, onclick} = $props()


</script>


<a href={href} onclick={onclick}>
    {text}{emoji}
</a>
<style>
    a {
        border: none;
        cursor: pointer;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 1.5rem;
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        transition: all 0.2s ease-in-out;
        margin: 10px;
        text-decoration: none;
        color: white;
    }

    a:hover {
        color: gold;
    }
</style>