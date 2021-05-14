import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import classnames from 'classnames';

export default ( { ...props } ) => {
  const { attributes, className } = props;
  const { container, noGutters, verticalAlignment } = attributes;

  const blockProps = useBlockProps.save();

  const rowClasses = classnames( {
    'row': true,
    'no-gutters': noGutters,
    [`align-items-${verticalAlignment}`] : verticalAlignment,
  } );

  const containerClasses = classnames( {
    'container': 'fixed' === container,
    'container-fluid': 'fluid' === container,
  } );

  return (
    <div { ...blockProps }>
      <div className={ containerClasses }>
        <div className={ rowClasses }>
          <InnerBlocks.Content />
        </div>
      </div>
    </div>
  );
};
