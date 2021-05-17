/*!
 * Editor
 *
 * Used in editing interface.
 */

// Blocks
import './../scripts/block-library/blocks/row';
import './../scripts/block-library/blocks/column';
import './../scripts/block-library/blocks/buttons';
import './../scripts/block-library/blocks/button';
import './../scripts/block-library/blocks/spacer';

import domReady from '@wordpress/dom-ready';
import { unregisterBlockType } from '@wordpress/blocks';

domReady( () => {

  // Unregister block types.
  [
    'core/column',
    'core/columns',
    'core/button',
    'core/buttons',
    'core/spacer',
  ].forEach( ( block ) => unregisterBlockType( block ) );

} );
