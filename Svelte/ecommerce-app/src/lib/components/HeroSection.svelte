<script>
	import snippet_book from "$assets/deLorean.png"
	import bookCover from "$assets/etl.png"
	import mobileCover from "$assets/etl_mobile.png"
	import { Button, Blink} from '$components/index.js';
</script>

<section class="hero">
	<div class="showcase">
		<h1>Life changing book</h1>
		<h1>BUY IT NOW!</h1>
		<Blink>
			<h2 class="red">
				25% OFF!!!
			</h2>
		</Blink>


		<img class="book-cover" src={bookCover} alt="">
		<img class="mobile-cover" src={mobileCover} alt="">
		<h5>Now available as e-book</h5>
	</div>
	<div class="hero-text text-center">

		<h1>THIS BOOK WILL</h1>
		<h1>ALTER YOUR LIFE</h1>
		<img class="snippet-book" src={snippet_book} alt="">
		<h1 class="gold">FOR THE BETTER</h1>

		<p class="mb-l">
			I entered the loop five years ago.
			After struggling with social interactions I went to a temple in Tibet and practiced "looping".
			Then suddenly I became sort of an expert on the human psyche and found the key to interact with these human beings.
			I will in this book reveal the secret to "loopholing " and other tips and tricks to have in your social-toolbox.
		</p>
		<Button class="regular">Buy book now</Button>
	</div>

</section>

<style>
	h4{
			font-style: italic;
	}
	h1:hover{
			color: gold;
	}
	.hero{
			display: flex;
			overflow-y: hidden;
			height: 100vh;
	}
	.showcase{
			position: relative;
			width: 50%;
			padding: 100px 16px 0 16px;
			text-align: center;
			background: linear-gradient(
			135deg,
			#e2cbff,
			#e2cbff 25%,
			#deeaff 50%,
			#ece5ff 75%,
			#927bce
			);
	}
	.hero-text{
			position: relative;
			padding: 100px 5%;
			width: 50%;
			color: white;
			background: black;

	}
	.snippet-book{
			right: 2%;
			width: 65%;
	}
	.book-cover{
			position: absolute;
			width: 35%;
			bottom: 0;
			right: 52%;
			transform: translateY(-50%)  rotateZ(-10deg);

	}
	.mobile-cover{
      position: absolute;
      right: 25%;
      width: 35%;
      bottom: 0;
      transform: translateY(-50%)  rotateZ(15deg);
      z-index: 2;

	}
</style>