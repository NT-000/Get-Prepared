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
		isDropdown?: boolean,
		isExpanded?: boolean,
		ariaLabel?: string,
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
		isExpanded,
		ariaLabel,
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
					class:btn-dropdown={isDropdown} class:btn-expanded={isExpanded}
					aria-label={ariaLabel}>{@render children()}
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
        display: flex;
        align-items: center;
        justify-content: space-between;
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
        background-color: transparent;
        border: none;
        color: rgb(14, 14, 14);
        border-radius: 12px;
        font-size: 40px;
    }

    .btn-isMenu:hover {
        background-color: transparent;
        font-weight: bold;
        border-bottom: 2px solid gold;
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
        display: inline-block;
        border: none;
        cursor: pointer;
        background-color: transparent !important;
        color: black;
    }

    .btn-dropdown:hover {
        background-color: transparent !important;
        border-bottom: 2px solid grey;
        opacity: 0.7;
        color: black;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-icon:hover {
        scale: 1.2;
    }

    .btn img {
        transition: transform 0.3s ease;
    }

    .btn-expanded :global(img) {
        transform: rotate(180deg) !important;
        width: 10%;

    }

    .btn-expanded {
        max-height: unset;
        opacity: 1;
    }


</style>