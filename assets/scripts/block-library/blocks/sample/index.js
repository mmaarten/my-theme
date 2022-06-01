import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import Block from './block';

registerBlockType( 'my-theme/sample', {
  apiVersion: 2,
  title: __( 'Sample', 'my-theme' ),
  description: __( 'Sample.', 'my-theme' ),
  category: 'common',
  attributes: {
		attribute: {
			type: 'string',
			default: '',
		}
	},
  edit ( props ) {
    return <Block { ...props } />
  },
  save() {
    return null;
  }
} );
