import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { columns as icon } from '@wordpress/icons';
import { getColumnClasses } from './common';

import edit from './edit';
import save from './save';

registerBlockType('my-theme/column', {
  apiVersion: 2,
  icon,
  title: __( 'Column', 'my-theme' ),
  description: __( 'Displays a column.', 'my-theme' ),
	category: 'common',
	parent: [ 'my-theme/row' ],
  supports: {
		anchor: true,
		reusable: false,
		html: false,
	},
  attributes: {
    width: {
      type: 'object',
      default: {},
    },
    offset: {
      type: 'object',
      default: {},
    },
    order: {
      type: 'object',
      default: {},
    },
  },
	edit,
	save,
});

import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';

// Add column classes
const withColumnClasses = createHigherOrderComponent( ( BlockListBlock ) => {
    return ( props ) => {
        if( props.name === 'my-theme/column' ) {
            const classes = getColumnClasses( props.attributes );
            return <BlockListBlock { ...props } className={ classes } />;
        } else {
            return <BlockListBlock {...props} />
        }
    };
}, 'withClientIdClassName' );

addFilter( 'editor.BlockListBlock', 'my-theme/with-column-classes', withColumnClasses );
