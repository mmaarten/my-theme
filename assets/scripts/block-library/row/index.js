import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { columns as icon } from '@wordpress/icons';

import edit from './edit';
import save from './save';

registerBlockType('my-theme/row', {
  apiVersion: 2,
  icon,
  title: __( 'Row', 'my-theme' ),
  description: __( 'Displays a row.', 'my-theme' ),
	category: 'common',
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
    },
  },
	edit,
	save,
});
