import classnames from 'classnames';

export const getButtonClasses = ( attributes ) => {
  const { type, outline, size, block } = attributes;
  return classnames('btn', {
    [`btn-${type}`]: type && !outline,
    [`btn-outline-${type}`]: type && outline,
    [`btn-${size}`]: size,
    'btn-block': block,
  });
}
