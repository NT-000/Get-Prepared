<script>
	import { PUBLIC_STRIPE_KEY } from '$env/static/public';
	import { loadStripe } from '@stripe/stripe-js';
	import { json } from '@sveltejs/kit';
	import { goto } from '$app/navigation';


	const { children, ...props } = $props();

	const onclick = async () => {
		try {
			const stripe = await loadStripe(PUBLIC_STRIPE_KEY);
			const response = await fetch('/api/checkout', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				}
			});

			const { sessionId } = await response.json();
			await stripe.redirectToCheckout({ sessionId });
		} catch (e) {
			await goto('/checkout/failure');
			return json({ error: e }, { status: 500 });
		}
	};


</script>

<button {...props} {onclick}>
	{@render children()}
</button>

<style>

    button {
        border: none;
        padding: 5px;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 1.2rem;
        transition: ease-out 0.3s;
        border-radius: 5px;
    }

    .regular {
        width: 20%;
        height: 3%;
        margin-top: 2%;
        font-weight: bold;

    }

    .regular:hover {
        width: 20%;
        height: 3%;
        background: linear-gradient(
                135deg,
                #fffbe5,
                #ffe066 25%,
                #ffd700 50%,
                #ffc300 75%,
                #b6862c
        );

    }

    .gradient-gold {
        background: linear-gradient(
                135deg,
                #fffbe5,
                #ffe066 25%,
                #ffd700 50%,
                #ffc300 75%,
                #b6862c
        );
    }

</style>