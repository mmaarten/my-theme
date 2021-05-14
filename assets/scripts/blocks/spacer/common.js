import classnames from 'classnames';
import { map, get } from 'lodash';
import { getBreakpointInfix, getGridBreakpoints } from '../../helpers';

export const getClasses = ( attributes ) => {
  const { sizes } = attributes;

  let classes = {};

  map( getGridBreakpoints(), ( breakpoint ) => {
    let infix = getBreakpointInfix( breakpoint );
    let breakpointSize = get( sizes, breakpoint );
    classes[`has-spacing${infix}-${breakpointSize}`] = breakpointSize;
  } );

  return classnames( classes );
}
