import './tooling.scss';

// Initialize.
document.addEventListener( 'DOMContentLoaded', () => {
	// Init ACF's preview.
	if ( window.acf ) {
		console.log( 'Hello from ' );
		window.acf.addAction(
			'render_block_preview/type=acf/tooling',
			initMyBlock
		);
	}
} );
