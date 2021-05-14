import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { getColumnClasses } from './common';

export default ( { ...props } ) => {
  const { attributes } = props;

  const blockProps = useBlockProps.save({
    className: getColumnClasses( attributes ),
  });

  return (
    <div { ...blockProps }>
      <InnerBlocks.Content />
    </div>
  );
};
