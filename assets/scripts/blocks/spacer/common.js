import classnames from 'classnames';
import { map, get } from 'lodash';

export const getClasses = ( attributes ) => {
  const { sizes } = attributes;

  let classes = {};

  map( ['xs', 'sm', 'md', 'lg', 'xl'], ( breakpoint ) => {
    let infix = 'xs' === breakpoint ? '' : `-${breakpoint}`;
    let breakpointSize = get( sizes, breakpoint );
    classes[`has-spacing${infix}-${breakpointSize}`] = breakpointSize;
  } );

  return classnames( classes );
}
