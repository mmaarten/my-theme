import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import classnames from 'classnames';

export default ( props ) => {
  const { attributes } = props;
  const { container, noGutters, verticalAlignment } = attributes;

  const blockProps = useBlockProps.save();

  const containerClasses = classnames({
    'container': 'fixed' === container,
    [`container-${ container }`]: container && 'fixed' !== container,
  });

  const rowClasses = classnames('row', {
    [`align-items-${ verticalAlignment }`]: verticalAlignment,
    'no-gutters': noGutters,
  });

  return (
    <>
      <div { ...blockProps }>
        <div className={ containerClasses }>
          <div className={ rowClasses }>
            <InnerBlocks.Content />
          </div>
        </div>
      </div>
    </>
  );
}
