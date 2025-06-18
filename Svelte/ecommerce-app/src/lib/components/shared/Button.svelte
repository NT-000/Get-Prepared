<script>
const {children, ...props} = $props()
</script>

<button {...props}>
	{@render children()}
</button>

<style>

		button {
				border: none;
				padding: 5px;
				cursor: pointer;
				text-transform: uppercase;
        font-size:1.2rem;
				transition: ease-out 0.3s;
        border-radius: 5px;
		}

		.regular{
	width: 20%;
			height: 3%;
				margin-top: 2%;
				font-weight: bold;

	}
		.regular:hover{
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
    .gradient-gold{
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