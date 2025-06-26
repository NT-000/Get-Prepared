<script>
	import { chevron_less } from '$components/index.js';

	let { faq, isExpanded, ...props } = $props();
</script>

<button class="container" class:select-question={!isExpanded} class:container-expanded={isExpanded} {...props}>
	<div class="question-and-answer">
		<p class="question mb-s">{faq.headline}</p>
		<p class="answer">
			{faq.snippet}
		</p>
	</div>
	<img src={chevron_less} alt="" />
</button>

<style>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 12px 0 12px 12px;
        border-bottom: 1px solid grey;
        text-align: left;
        width: 100%;
    }

    .select-question:hover {
        transform: scale(1.02);
        border-bottom: 3px solid black;
    }

    .question-and-answer {
        padding-right: 150px;
        flex-grow: 1;
    }

    .answer {
        max-height: 0;
        font: 400 14px "Lucida Grande", Helvetica, Arial, sans-serif;
        overflow: hidden;
        opacity: 0;
        transition: max-height 0.3s ease-out,
        opacity 0.3s ease-out;
    }

    button {
        background: none;
        border: none;
    }

    button img {
        width: 24px;
        height: 24px;
        transition: transform 0.3s linear;
    }

    .question {
        font-weight: 600;
    }

    .container-expanded img {
        transform: rotate(180deg);
    }

    .container-expanded .answer {
        max-height: unset;
        opacity: 1;
    }

</style>