<script>

    const {href, text, onclick} = $props()


</script>


<a href={href} onclick={onclick}>
    {text}
</a>
<style>
    a {
        border: none;
        cursor: pointer;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 1rem;
        font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
        transition: all 0.2s ease-in-out;
        margin: 10px;
        text-decoration: none;
        color: white;
    }

    a:hover {
        border-bottom: 4px solid #005fcc;
    }
</style>