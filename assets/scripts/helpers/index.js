
export const getGridColumns = () => {
  return 12;
};

export const getGridBreakpoints = () => {
  return ['xs', 'md', 'xl'];
};

export const getBreakpointInfix = ( breakpoint ) => {
  return 'xs' === breakpoint ? '' : `-${breakpoint}`;
};
