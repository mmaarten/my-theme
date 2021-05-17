import { map } from 'lodash'

export const getGridColumns = () => {
  return 12;
}

export const getGridBreakpoints = () => {
  return ['xs', 'md', 'xl'];
}

export const getBreakpointInfix = ( breakpoint ) => {
  return 'xs' === breakpoint ? '' : `-${ breakpoint }`;
}

export const getSelectOptions = ( obj ) => {
  return map( obj, ( label, value ) => ( { label, value } ) );
}
