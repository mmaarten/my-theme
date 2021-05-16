import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { button as icon } from '@wordpress/icons';

import edit from './edit';
import save from './save';

registerBlockType( 'my-theme/button', {
  apiVersion: 2,
  icon,
  title: __( 'Button', 'my-theme' ),
  description: __( 'Displays a button.', 'my-theme' ),
  category: 'common',
  attributes: {
    text: {
      type: 'string',
      default: '',
    },
    link: {
      type: 'string',
      default: '',
    },
    linkTab: {
      type: 'boolean',
      default: false,
    },
    type: {
      type: 'string',
      default: 'primary',
    },
    outline: {
      type: 'boolean',
      default: false,
    },
    size: {
      type: 'string',
      default: '',
    },
    block: {
      type: 'boolean',
      default: false,
    },
    toggle: {
      type: 'string',
      default: '',
    },
  },
  edit,
  save,
} );
