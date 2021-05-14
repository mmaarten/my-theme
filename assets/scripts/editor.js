import { unregisterBlockType } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';

import './components/';

const unregisterBlockTypes = () => {
  const blockTypes = [
    'core/buttons',
    'core/button',
    'core/columns',
    'core/column',
    'core/spacer',
  ];

  blockTypes.forEach( ( name ) => {
    unregisterBlockType( name );
  } );
};

domReady( () => {

  //
  // Unregister block types.
  //
  unregisterBlockTypes();

} );
