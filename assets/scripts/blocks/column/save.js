import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import classnames from 'classnames';
import { getColumnClasses } from './common';

export default ( { ...props } ) => {
  const { attributes } = props;

  const blockProps = useBlockProps.save({
    className: classnames(getColumnClasses( attributes )),
  });

  return (
    <div { ...blockProps }>
      <InnerBlocks.Content />
    </div>
  );
};
