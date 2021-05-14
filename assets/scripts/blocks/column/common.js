import classnames from 'classnames';
import { map, get } from 'lodash';

export const getColumnClasses = ( attributes ) => {
  const { width, offset, order } = attributes;
  const FALLBACK_CLASS = 'col';

  let classes = {};

  // Add `col` class for when no width is set.
  classes[ FALLBACK_CLASS ] = true;

  map( ['xs', 'sm', 'md', 'lg', 'xl'], ( breakpoint ) => {
    let infix = 'xs' === breakpoint ? '' : `-${breakpoint}`;

    let breakpointWidth = get( width, breakpoint );
    let breakpointOffset = get( offset, breakpoint );
    let breakpointOrder = get( order, breakpoint );

    classes[`col${infix}-${breakpointWidth}`] = breakpointWidth;
    classes[`offset${infix}-${breakpointOffset}`] = breakpointOffset;
    classes[`order${infix}-${breakpointOrder}`] = breakpointOrder;

    // Width is set. Remove `col` class.
    if ( breakpointWidth && classes[ FALLBACK_CLASS ] ) {
      classes[ FALLBACK_CLASS ] = false;
    };
  } );

  return classnames( classes );
}
