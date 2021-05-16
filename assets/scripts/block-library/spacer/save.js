import { useBlockProps } from '@wordpress/block-editor';
import { getSpacerClasses } from './common';

export default ( props ) => {
  const { attributes } = props;

  const blockProps = useBlockProps.save({
    className: getSpacerClasses( attributes ),
    'aria-hidden': 'true',
  });

  return (
    <div { ...blockProps } />
  );
};
