import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

import edit from './edit';
import save from './save';

registerBlockType( 'my/spacer', {
  apiVersion: 2,
  title: __( 'Spacer', 'my-theme' ),
  description: __( 'Displays a spacer.', 'my-theme' ),
  category: 'common',
  attributes: {
    sizes: {
      type: 'object',
      default: { xs: 4 },
    },
  },
  edit,
  save,
} );
