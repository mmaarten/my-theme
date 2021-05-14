import { useBlockProps } from '@wordpress/block-editor';
import { getClasses } from './common';

export default ( props ) => {
  const { attributes } = props;

  const blockProps = useBlockProps.save({
    className: getClasses( attributes ),
    'aria-hidden': 'true',
  });

  return (
    <div { ...blockProps } />
  );
};
