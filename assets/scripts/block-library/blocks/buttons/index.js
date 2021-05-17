import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { buttons as icon } from '@wordpress/icons';

import edit from './edit';
import save from './save';

registerBlockType( 'my-theme/buttons', {
  apiVersion: 2,
  icon,
  title: __( 'Buttons', 'my-theme' ),
  description: __( 'Displays buttons.', 'my-theme' ),
  category: 'common',
  attributes: {
    justifyContent: {
      type: 'string',
      default: 'left',
    },
  },
  edit,
  save,
} );
