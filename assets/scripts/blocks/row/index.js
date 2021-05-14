import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import edit from './edit';
import save from './save';

registerBlockType( 'my/row', {
  apiVersion: 2,
	title: __( 'Row', 'my-theme' ),
  description: __( 'Displays a row.', 'my-theme' ),
	category: 'common',
	keywords: [ __( 'My Theme', 'my-theme' ) ],
	supports: {
		align: ['wide', 'full'],
    anchor: true,
	},
  attributes: {
    align: {
      type: 'string',
      default: 'full',
    },
    container: {
      type: 'string',
      default: 'fixed',
    },
    noGutters : {
      type: 'boolean',
			default: false,
    },
    verticalAlignment : {
      type : 'string',
    }
  },
	edit,
	save,
});
