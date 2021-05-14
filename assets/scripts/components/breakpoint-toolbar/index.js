import { __ } from '@wordpress/i18n';
import { Toolbar, ToolbarButton } from '@wordpress/components';
import { withState } from '@wordpress/compose';
import { mobile, desktop, tablet } from '@wordpress/icons';
import { map, get } from 'lodash';
import { getGridBreakpoints } from '../../helpers';

const BreakpointToolbar = ( {
  activeBreakpoint,
  setState,
  onChange,
} ) => {

  const controls = {
    xs : {
      icon: mobile,
      label: __( 'Extra Small Devices', 'my-theme' ),
    },
    sm : {
      icon: tablet,
      label: __( 'Small Devices', 'my-theme' ),
    },
    md : {
      icon: tablet,
      label: __( 'Medium Devices', 'my-theme' ),
    },
    lg : {
      icon: desktop,
      label: __( 'Large Devices', 'my-theme' ),
    },
    xl : {
      icon: desktop,
      label: __( 'Extra Large Devices', 'my-theme' ),
    }
  };

  return (
    <>
      <Toolbar label={ __( 'Devices navigation', 'my-theme' ) } className="my-theme-breakpoint-toolbar">
        { map( getGridBreakpoints(), ( breakpoint, index ) => {
          let control = get( controls, breakpoint );
          return control && (
            <ToolbarButton
              key={ index }
              icon={ control.icon }
              label={ control.label }
              onClick={ () => { setState( { activeBreakpoint : breakpoint } ) } }
              isPressed={ breakpoint === activeBreakpoint }
            />
          )
        } ) }
      </Toolbar>
      { onChange && onChange( activeBreakpoint ) }
    </>
  );
};

export default withState( {
  activeBreakpoint: 'xs',
} )( BreakpointToolbar );
