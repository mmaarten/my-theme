import {
  __,
} from '@wordpress/i18n';
import {
  registerBlockType,
} from '@wordpress/blocks';

import edit from './edit';
import save from './save';

registerBlockType( 'my-theme/sample', {
	title: __( 'Sample', 'my-theme' ),
  description: __( 'Sample block.', 'my-theme' ),
	category: 'common',
	keywords: [ __( 'My Theme', 'my-theme' ) ],
	supports: {
		align: ['wide', 'full'],
	},
  attributes: {
		content: {
			type: 'string',
			default: 'Content',
		},
  },
	edit,
	save,
});
