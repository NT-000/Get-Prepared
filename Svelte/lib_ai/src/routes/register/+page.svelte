<script lang="ts">
    import {AuthForm} from "$components";

    let {form} = $props();

    $inspect(form)
</script>


<AuthForm isRegistration={true} {form}/>

<style>

</style>