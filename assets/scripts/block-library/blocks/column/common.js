import { getBreakpointInfix, getConfig } from '../../helpers';
import { map, get } from 'lodash';
import classnames from 'classnames';

export const getColumnClasses = ( attributes ) => {
  const { width, offset, order } = attributes;
  const breakpoints = getConfig( 'gridBreakpoints' );
  const FALLBACK_CLASS = 'col';

  let classes = { [ FALLBACK_CLASS ] : true };

  map( breakpoints, ( breakpoint ) => {
    let infix = getBreakpointInfix( breakpoint );

    let breakpointWidth = get( width, breakpoint );
    let breakpointOffset = get( offset, breakpoint );
    let breakpointOrder = get( order, breakpoint );

    classes[`col${ infix }-${ breakpointWidth }`] = breakpointWidth;
    classes[`offset${ infix }-${ breakpointOffset }`] = breakpointOffset;
    classes[`order${ infix }-${ breakpointOrder }`] = breakpointOrder;

    if ( breakpointWidth ) {
      classes[ FALLBACK_CLASS ] = false;
    }

  } );

  return classnames( classes );
}
