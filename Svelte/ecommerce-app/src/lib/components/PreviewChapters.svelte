<script>
	const chapters = [
		{
			id: 1,
			chapterName: 'Starting out',
			headline: 'Human connections, understanding social cues and eye contact',
			snippet: '\t\t\t\tOn first contact with other Homo sapiens it\'s essential to greet them.\n' +
				'\t\t\t\tTry phrases like; "Hello, how are you?", "The weather is nice today.", "How is your life?"\n' +
				'\t\t\t\tSome Homo sapiens likes a firm handshake and others like them sloppy.\n' +
				'\t\t\t\tThere\'s no definitive successful initial interaction, sometimes you just got to shoot from the hip and bow your head gracefully before exiting the situation.\n' +
				'\t\t\t\tDon\'t make too much eye contact, as it can scare them away, there are other ways to assert domination - but that\'s for a later chapter.'
		},

		{
			id: 2,
			chapterName: 'The Art of Small Talk',
			headline: 'Reading the room, spotting conversation starters, and when to nod',
			snippet: 'On your continued exploration of Homo sapiens, you\'ll notice they often fill silences with what they call "small talk". This ritual involves discussing topics like the weather, local sports teams, or the price of avocados. It\'s less about the topic and more about signaling friendliness. If stuck, just agree that "the weather has been crazy lately" and give a knowing nod. Nodding shows you’re engaged and replying with a simple "mhm", even if you zoned out five minutes ago.'
		},

		{
			id: 3,
			chapterName: 'Navigating Group Dynamics',
			headline: 'Surviving packs and spotting the alpha',
			snippet: 'Homo sapiens rarely operate alone; they form groups, sometimes called "meetings" or "parties". Observe the body language: who talks the most? Who laughs first? That’s the group’s alpha. Avoid interrupting them—unless you crave the thrill of awkward silence. If you make a social mistake, just laugh it off and blame your upbringing or a mysterious “cultural difference.”'
		},

		{
			id: 4,
			chapterName: 'Texting Etiquette for Beginners',
			headline: 'Emojis, exclamation marks, and the dangers of opened messages',
			snippet: 'Communicating via thumbs has its own rules. Use emojis for emotion, but not too many, unless you want to seem unhinged. Exclamation marks make you look friendly!!! But beware: too many and you risk sounding desperate. Finally, if you read a message and don\'t reply, you may be accused of "leaving someone on seen". It’s a social crime. Pretend you lost your phone or say your in a "tough spot" these days because someone in close to you died - if confronted.'
		},

		{
			id: 5,
			chapterName: 'Handling Awkward Moments',
			headline: 'Recovering from blunders, dropped jokes, and accidental eye contact',
			snippet: 'No guide can save you from every awkward moment, but here’s the trick: make everyone else feel more awkward than yourself. If you tell a joke and no one laughs, just laugh for everyone else too. Accidentally wave at someone who wasn’t waving at you? Nod with confidence—they’ll think you’re greeting someone behind them.'
		},

		{
			id: 6,
			chapterName: 'Handling conversations in the DeLorean',
			headline: 'Why all real conversations happen in the DeLorean (and nowhere else)',
			snippet: 'When it comes to important one-on-one conversations, tradition dictates that they must take place inside the DeLorean.\n' +
				'Regular rooms just don’t cut it - create the right atmosphere for real talk.\n' +
				'Whether it’s deep secrets, awkward confessions, death, or a code along - the stench of vintage fun lays the foundation for the conversation.\n' +
				'The DeLorean removes all awkwardness from every conversations.'
		}];

	let selectedChapter = $state(1);

</script>

<section class="page-section">
	<h2 class="mb-l">Chapter Preview</h2>
	<div class="chapter-container">
		<ul>
			{#each chapters as chapter (chapter.id)}

				<li>
					<button class="chapter-title"
									class:selected-chapter-title={selectedChapter === chapter.id}
									aria-controls={`chapter-info-${chapter.id}`}
									aria-expanded={selectedChapter === chapter.id}
									onclick={() => selectedChapter = chapter.id}>
						<h3>Chapter {chapter.id}: {chapter.chapterName} </h3>
					</button>
				</li>

			{/each}

		</ul>
		<div class="chapter-info">
			{#each chapters as chapter (chapter.id)}
				{#if selectedChapter === chapter.id}
					<h3 class="mb-small">
						{chapter.headline}
					</h3>
					<p>
						{chapter.snippet}
					</p>
				{/if}
			{/each}
		</div>
	</div>
</section>

<style>
    h3:hover {
        cursor: pointer;
    }

    .chapter-container {
        display: flex;
        justify-content: space-between;

    }

    .chapter-container ul {
        width: 40%;
        list-style: none;
    }

    .chapter-info {
        width: 55%;
    }

    .chapter-title {
        width: 100%;
        display: block;
        padding: 12px;
        text-align: left;
        border: none;
    }

    .selected-chapter-title {
        background: black;
        color: white;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2),
        0 1px 3px rgba(0, 0, 0, 0.08);

    }
</style>