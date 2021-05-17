import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import classnames from 'classnames';

export default ( props ) => {
  const { attributes } = props;
  const { justifyContent } = attributes;

  const blockProps = useBlockProps.save({
    className : classnames( 'd-flex', 'flex-wrap', 'align-items-center', {
      [`justify-content-${justifyContent}`]: justifyContent,
    })
  });

  return (
    <div { ...blockProps }>
      <InnerBlocks.Content />
    </div>
  );
};
