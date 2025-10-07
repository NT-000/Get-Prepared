<script lang="ts">

	import type { Snippet } from 'svelte';

	interface BasicProps {
		children: Snippet;
		isSecondary?: boolean,
		isWarning?: boolean,
		isMenu?: boolean,
		isRate?: boolean,
		isSelected?: boolean,
		isIcon?: boolean,
		isDropdown?: boolean
	}

	interface ButtonProps extends BasicProps {
		onclick: (e: MouseEvent) => void;
		href?: never;
		type?: 'submit' | 'button';
	}

	interface LinkProps extends BasicProps {
		href: string;
		onclick?: never;
	}


	type ComponentProps = ButtonProps | LinkProps

	let {
		children,
		href,
		onclick,
		isSecondary,
		isWarning,
		isMenu,
		isRate,
		isSelected,
		isIcon,
		isDropdown,
		...props
	}: ComponentProps = $props();

</script>

{#if href}
	<a {href} class="btn" class:btn-secondary={isSecondary} class:btn-danger={isWarning} class:btn-isMenu={isMenu}>
		{@render children()}
	</a>
{:else}
	<button {...props} {onclick} class="btn" class:btn-secondary={isSecondary} class:btn-danger={isWarning}
					class:btn-isMenu={isMenu} class:btn-isRate={isRate}
					class:btn-isSelected={isSelected} class:btn-icon={isIcon}
					class:btn-dropdown={isDropdown}>{@render children()}
	</button>
{/if}

<style>

    a {
        text-decoration: none;
        display: block;
    }

    a:hover {
        text-decoration: none;
    }

    .btn {
        padding: 12px 24px 10px 10px;
        min-width: 220px;
        text-align: center;
        background: black;
        color: white;
        cursor: pointer;
        border-radius: 12px;
        border: 1px solid white;
        font-size: 24px;
        font-style: italic;
        font-weight: bold;
        margin: auto;
    }

    .btn:hover {
        background: deepskyblue;
    }

    .btn-secondary {
        background-color: white;
        color: black;
        border-radius: 12px;
        border: 1px solid black;
    }

    .btn-danger:hover {
        background-color: orangered;
        color: black;
        border: 3px solid orange;
    }

    .btn-isMenu {
        min-width: 150px;
        padding: 8px 20px;
    }

    .btn-isRate {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        padding: 0;
        color: transparent;
    }

    .btn-isSelected {
        color: deepskyblue;
    }

    .btn-icon {
        background-color: transparent !important;
        font-size: 40px !important;
        color: black !important;
        border: none !important;
    }

    .btn-dropdown {
        border: none;
        cursor: pointer;
        background-color: transparent;
        color: black;
    }

    .btn-dropdown:hover {
        background-color: transparent;
        border-bottom: 5px solid grey;
        opacity: .7;
        color: black;
        border-radius: 10px;
        cursor: pointer;
    }

    .btn-icon:hover {
        scale: 1.2;
    }


</style>