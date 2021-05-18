import { get } from 'lodash'
import config from '../config';

export const getConfig = ( key ) => {
  return get( config, key );
}

export const getBreakpointInfix = ( breakpoint ) => {
  return 'xs' === breakpoint ? '' : `-${ breakpoint }`;
}
