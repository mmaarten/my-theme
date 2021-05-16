/*!
 * Editor
 *
 * Used in editing interface.
 */

// Blocks
import './../scripts/block-library/row';
import './../scripts/block-library/column';
import './../scripts/block-library/buttons';
import './../scripts/block-library/button';
import './../scripts/block-library/spacer';

import domReady from '@wordpress/dom-ready';
import { unregisterBlockType } from '@wordpress/blocks';

domReady( () => {

  // Unregister blocks
  [
    'core/column',
    'core/columns',
    'core/button',
    'core/buttons',
    'core/spacer',
  ].forEach( ( block ) => unregisterBlockType( block ) );

} );
