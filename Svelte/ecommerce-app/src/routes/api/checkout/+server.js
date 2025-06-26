import { json } from '@sveltejs/kit';
import Stripe from 'stripe';
import { PRICE_ID, SECRET_STRIPE_API_KEY } from '$env/static/private';
import { PUBLIC_FRONTEND_URL } from '$env/static/public';

const stripe = new Stripe(SECRET_STRIPE_API_KEY);

export async function POST() {
	try {
		const session = await stripe.checkout.sessions.create({
			payment_method_types: ['card'],
			line_items: [
				{
					price: PRICE_ID,
					quantity: 1
				}
			],
			mode: 'payment',
			success_url: `${PUBLIC_FRONTEND_URL}/checkout/success`,
			cancel_url: `${PUBLIC_FRONTEND_URL}/checkout/failure`
		});
		return json({ success: true, sessionId: session.id });
	} catch (e) {
		return json({ error: e }, { status: 500 });
	}
}
