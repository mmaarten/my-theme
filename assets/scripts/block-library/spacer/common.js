import classnames from 'classnames';
import { map, get } from 'lodash';
import { getBreakpointInfix, getGridBreakpoints } from '../../helpers';

export const getSpacerClasses = ( attributes ) => {
  const { sizes } = attributes;
  const breakpoints = getGridBreakpoints();
  let classes = {};
  map( breakpoints, ( breakpoint ) => {
    let infix = getBreakpointInfix( breakpoint );
    let breakpointSize = get( sizes, breakpoint );
    classes[`has-spacing${infix}-${breakpointSize}`] = breakpointSize;
  } );

  return classnames( classes );
}
