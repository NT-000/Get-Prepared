<script lang="ts">
    import Icon from "@iconify/svelte";
</script>

<nav class="side-navigation">
    <ul>
        <li>
            <a href="/private/dashboard">
                <Icon icon="famicons:library-outline" width={"40"}/>
            </a>
        </li>

        <li>
            <a href="/private/scan-shelf">
                <Icon icon="solar:eye-scan-linear" width={"40"}/>
            </a>
        </li>

        <li>
            <a href="/private/settings">
                <Icon icon="famicons:settings-outline" width={"40"}/>
            </a>
        </li>
    </ul>
</nav>

<style>
    .side-navigation {
        display: flex;
        height: 100vh;
        border-right: 2px solid grey;
        padding: calc(4vw - 16px) 40px calc(4vw - 16px) calc(4vw - 16px);
        flex: 0 0 auto;
        position: sticky;
        top: 0;
    }

    .side-navigation ul {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    ul li:not(:last-of-type) {
        margin-bottom: 16px;
    }
</style>