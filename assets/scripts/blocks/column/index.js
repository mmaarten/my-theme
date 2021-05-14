import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { getColumnClasses } from './common';

import edit from './edit';
import save from './save';

registerBlockType( 'my/column', {
  apiVersion: 2,
	title: __( 'Column', 'my-theme' ),
  description: __( 'Displays a column.', 'my-theme' ),
	category: 'common',
	keywords: [ __( 'My Theme', 'my-theme' ) ],
  parent: [ 'my/row' ],
  supports: {
		inserter: false,
		reusable: false,
		html: false,
	},
  attributes: {
    width : {
      type: 'object',
    },
    offset : {
      type: 'object',
    },
    order : {
      type: 'object',
    },
  },
	edit,
	save,
});

import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import classnames from 'classnames';
import { map } from 'lodash';

const addColumnClasses = createHigherOrderComponent( ( BlockListBlock ) => {
    return ( props ) => {
        // Return when not our block.
        if ( 'my/column' !== props.name ) {
          return <BlockListBlock { ...props } />
        }

        // Get classes
        const vendorClasses = getColumnClasses( props.attributes );
        // Add prefixes
        let classes = {};
        map( vendorClasses, ( use, className ) => {
          classes[ `has-${ className }` ] = use;
        } );

        return (
            <BlockListBlock { ...props } className={ classnames( classes ) } />
        );
    };
}, 'withColumnClasses' );

addFilter( 'editor.BlockListBlock', 'my-theme/add-column-classes', addColumnClasses );
