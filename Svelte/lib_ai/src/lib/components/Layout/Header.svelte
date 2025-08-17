<script lang="ts">

    import logo from "$assets/logo.png"
    import {Button} from "$components"

</script>

<header>
    <a href="/">
        <img src="{logo}" class="logo" alt="home">
    </a>


<nav>
    <ul>
        <li>
            <Button href="/register" isMenu="{true}">Create new account</Button>
        </li>
        <li>
            <Button href="/login" isMenu={true} isSecondary={true}>Login</Button>
        </li>
    </ul>
</nav>
</header>

<style>
    .logo
    {
        max-width: 72px;
    }
    header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 4vw;
    }
    ul{
        display: flex;
        column-gap: 24px;
    }
    li{
        list-style: none;
    }
</style>