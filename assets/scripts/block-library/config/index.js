import { __ } from '@wordpress/i18n';

const config = {
  gridColumns: 12,
  gridBreakpoints: ['xs', 'md', 'xl'],
  themeColors: [
    { label: __( 'Primary', 'my-theme' ), value: 'primary' },
    { label: __( 'Secondary', 'my-theme' ), value: 'secondary' },
  ],
  spacers: [
    { label: __( 'Small', 'my-theme' ), value: 3 },
    { label: __( 'Medium', 'my-theme' ), value: 4 },
    { label: __( 'Large', 'my-theme' ), value: 5 },
  ],
};

export default config;
