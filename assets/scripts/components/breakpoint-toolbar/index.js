import { __ } from '@wordpress/i18n';
import { Toolbar } from '@wordpress/components';
import { withState } from '@wordpress/compose';

const BreakpointToolbar = ( {
  breakpoint,
  setState,
  onChange,
} ) => {

  return (
    <>
      <Toolbar
        controls={ [
          {
            icon: 'smartphone',
            title: __( 'Extra Small Devices', 'my-theme' ),
            isActive: 'xs' === breakpoint,
            onClick: () => { setState( { breakpoint: 'xs' } ) },
          },
          {
            icon: 'smartphone',
            title: __( 'Small Devices', 'my-theme' ),
            isActive: 'sm' === breakpoint,
            onClick: () => { setState( { breakpoint: 'sm' } ) },
          },
          {
            icon: 'tablet',
            title: __( 'Medium Devices', 'my-theme' ),
            isActive: 'md' === breakpoint,
            onClick: () => { setState( { breakpoint: 'md' } ) },
          },
          {
            icon: 'desktop',
            title: __( 'Large Devices', 'my-theme' ),
            isActive: 'lg' === breakpoint,
            onClick: () => { setState( { breakpoint: 'lg' } ) },
          },
          {
            icon: 'desktop',
            title: __( 'Extra Large Devices', 'my-theme' ),
            isActive: 'xl' === breakpoint,
            onClick: () => { setState( { breakpoint: 'xl' } ) },
          }
        ] }
      />
      { onChange && onChange( breakpoint ) }
    </>
  );
};

export default withState( {
  breakpoint: 'md',
} )( BreakpointToolbar );
