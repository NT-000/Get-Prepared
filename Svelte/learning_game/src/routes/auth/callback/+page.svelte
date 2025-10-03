<script lang="ts">
	import { onMount } from 'svelte';
	import { goto, invalidateAll } from '$app/navigation';
	import { supabase } from '$lib/supabase/client';


	let status = $state('Processing login...');
	let error = $state('');


	onMount(async () => {

		let { data: { session } } = await supabase.auth.getSession();

		if (session) {
			await invalidateAll();
			await goto('/private/dashboard');
		}

	});
</script>

<div class="callback-container">
	<div class="callback-card">
		<div class="spinner-container">
			<div class="spinner"></div>
		</div>

		<h2>{status}</h2>

		{#if error}
			<p class="error-message">{error}</p>
		{:else}
			<p>Vent litt til...</p>
		{/if}
	</div>
</div>

<style>
    .callback-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .callback-card {
        background: white;
        border-radius: 12px;
        padding: 3rem;
        text-align: center;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        max-width: 400px;
    }

    .spinner-container {
        margin-bottom: 2rem;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #e2e8f0;
        border-top-color: #667eea;
        border-radius: 50%;
        margin: 0 auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    h2 {
        color: #2d3748;
        margin: 0 0 1rem 0;
        font-size: 1.5rem;
    }

    p {
        color: #718096;
        margin: 0;
    }

    .error-message {
        color: #e53e3e;
        background: #fed7d7;
        padding: 0.75rem;
        border-radius: 6px;
        margin-top: 1rem;
    }
</style>