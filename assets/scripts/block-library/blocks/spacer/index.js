import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { resizeCornerNE as icon } from '@wordpress/icons';

import edit from './edit';
import save from './save';

registerBlockType( 'my-theme/spacer', {
  apiVersion: 2,
  icon,
  title: __( 'Spacer', 'my-theme' ),
  description: __( 'Displays a spacer.', 'my-theme' ),
  category: 'common',
  supports: {
    align: ['wide', 'full'],
  },
  attributes: {
    align: {
      type: 'string',
      default: 'full',
    },
    sizes: {
      type: 'object',
      default: { xs: 4 },
    },
  },
  edit,
  save,
} );
