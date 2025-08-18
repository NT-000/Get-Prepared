<script lang="ts">
    import {AuthForm} from "$components";

    let {form} = $props();

    $inspect(form)
</script>

<AuthForm isRegistration={false} {form}/>

<style>

</style>