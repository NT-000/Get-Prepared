<script>
    import {fade, fly} from "svelte/transition";
</script>

<footer>
    <div class="copyright" in:fade>
        © 2025 CockRoach Media
    </div>
</footer>

<style>
footer{
    padding: 40px;
    text-align: center;
}
.copyright{
    color: #aaa;
    font-size: 14px;
    display: inline-block;
    padding: 20px;
    border-top: 1px solid #ddd;

}
</style>