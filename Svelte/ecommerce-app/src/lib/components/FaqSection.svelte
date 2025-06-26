<script>

	import { Button, FaqItem } from '$components/index.js';
	import logo from '$assets/x-logo.png';

	const faqs = [{
		id: 1,
		headline: 'What will I learn from this book',
		snippet: 'With this book you will learn the art of connecting with other beings, learn hidden social cues and get the mindset of an apex preadator.'
	},
		{
			id: 2,
			headline: 'Who is this book for?',
			snippet: 'This book is for people who wants to conquer the art of socializing.'
		},
		{
			id: 3,
			headline: 'What\'s the price of the book?',
			snippet: 'The current price of the book is $30, off 25% for a limited time.'
		},
		{
			id: 4,
			headline: 'Is the information in the book up-to-date?',
			snippet: 'Yes, it is as fresh as the summer breeze.'
		},
		{ id: 5, headline: 'Can I get a refund if I\'m not satisfied?', snippet: 'Sorry, no refunds.' },
		{
			id: 6,
			headline: 'Will this book change my perception of the world?',
			snippet: 'Yes, indeed this is a life-altering experience and will probably change your world-view for the better.'
		}
	];

	let selectedFaq = $state(-1);

	let onclick = (id) => {
		if (selectedFaq === id) {
			selectedFaq = -1;
		} else {
			selectedFaq = id;
		}
	};
</script>

<section class="page-section">
	<div class="faq-container">
		<h2 class="mb-l">Frequently asked questions</h2>
		<div class="faqs">
			<ul style="list-style: none">
				{#each faqs as faq (faq.id)}
					<FaqItem {faq} isExpanded={faq.id === selectedFaq} onclick={() => onclick(faq.id)} />
				{/each}
			</ul>
		</div>
	</div>
	<div class="additional-info mt-m">
		<Button class="regular mb-m">Buy now</Button>
		<a href="https://x.com">
			<p>Follow me on <img src="{logo}" alt="x-icon" class="x-icon" /></p>
		</a>

	</div>
</section>

<style>

    .faq-container {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-align: left;
    }

    .additional-info a {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .faqs:hover {
        cursor: pointer;
    }


    .x-icon {
        height: 36px;
        width: 36px;
        display: inline-block;
    }


    img {
        display: block;
        transition: transform 0.3s linear;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>