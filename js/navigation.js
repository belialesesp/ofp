/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 *
 */
( function() {
	'use strict';

	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// ── Hamburger toggle ────────────────────────────────────────────────────
	button.addEventListener( 'click', function() {
		const expanded = button.getAttribute( 'aria-expanded' ) === 'true';
		siteNavigation.classList.toggle( 'toggled' );
		button.setAttribute( 'aria-expanded', String( ! expanded ) );
	} );

	// ── Outside-click: close the menu ───────────────────────────────────────
	// Only mutates the DOM when the nav is actually open, avoiding needless
	// reflows on every click elsewhere on the page.
	document.addEventListener( 'click', function( event ) {
		if ( ! siteNavigation.classList.contains( 'toggled' ) ) {
			return;
		}
		if ( ! siteNavigation.contains( event.target ) ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// ── Focus management: delegated listeners on the menu ───────────────────
	// Previously attached one focus + one blur + one touchstart handler per
	// <a> element. Delegation cuts that to two listeners total regardless of
	// how many menu items exist, and it works for items injected later.

	/**
	 * Walk up from `el` to the nearest .nav-menu ancestor, toggling the
	 * .focus class on each <li> encountered on the way.
	 *
	 * @param {Element} el   - The element to start from.
	 * @param {boolean} add  - true to add .focus, false to remove it.
	 */
	function setFocusChain( el, add ) {
		let node = el;
		while ( node && ! node.classList.contains( 'nav-menu' ) ) {
			if ( node.tagName.toLowerCase() === 'li' ) {
				node.classList.toggle( 'focus', add );
			}
			node = node.parentNode;
		}
	}

	// Delegated focus listener (useCapture = true so it fires for all
	// descendants, matching the original per-element capture behaviour).
	menu.addEventListener( 'focus', function( event ) {
		if ( event.target.tagName.toLowerCase() === 'a' ) {
			setFocusChain( event.target, true );
		}
	}, true );

	menu.addEventListener( 'blur', function( event ) {
		if ( event.target.tagName.toLowerCase() === 'a' ) {
			setFocusChain( event.target, false );
		}
	}, true );

	// Delegated touchstart for parent items (dropdown open on touch).
	menu.addEventListener( 'touchstart', function( event ) {
		const link = event.target.closest( '.menu-item-has-children > a, .page_item_has_children > a' );
		if ( ! link ) {
			return;
		}

		const menuItem = link.parentNode;
		event.preventDefault();

		// Remove .focus from all siblings, then toggle it on the tapped item.
		for ( const sibling of menuItem.parentNode.children ) {
			if ( sibling !== menuItem ) {
				sibling.classList.remove( 'focus' );
			}
		}
		menuItem.classList.toggle( 'focus' );
	}, false );

}() );