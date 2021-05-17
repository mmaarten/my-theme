import { __ } from '@wordpress/i18n';
import { PanelBody, SelectControl, ToggleControl, Toolbar, ToolbarButton } from '@wordpress/components';
import { InspectorControls, useBlockProps, InnerBlocks, BlockControls } from '@wordpress/block-editor';
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { createBlock } from '@wordpress/blocks';
import { plus } from '@wordpress/icons';

import classnames from 'classnames';

const RowEdit = ( props ) => {
  const { attributes, setAttributes, addBlock } = props;
  const { container, noGutters, verticalAlignment } = attributes;

  const ALLOWED_BLOCKS = [ 'my-theme/column' ];
  const BLOCKS_TEMPLATE = [ [ 'my-theme/column' ] ];

  const blockProps = useBlockProps({
    className: classnames({
      'has-container': 'fixed' === container,
      [`has-container-${ container }`]: container && 'fixed' !== container,
      [`has-align-items-${ verticalAlignment }`]: verticalAlignment,
      'has-no-gutters': noGutters,
    }),
  });

  return (
    <>
      <InspectorControls>
        <PanelBody initialOpen={ true }>
          <SelectControl
            label={ __('Container', 'my-theme') }
            value={ container }
            onChange={ ( container ) => setAttributes( { container } ) }
            options={ [
              { label: __( 'Fixed Width', 'my-theme' ), value: 'fixed' },
              { label: __( 'Full Width', 'my-theme' ), value: 'fluid' },
            ] }
          />
          <ToggleControl
            label={ __( 'No Gutters', 'my-theme' ) }
            checked={ noGutters }
            onChange={ ( noGutters ) => setAttributes( { noGutters } ) }
          />
          <SelectControl
            label={ __( 'Vertically Align' ) }
            options={ [
              { label: __('- Select -', 'my-theme'), value: '' },
              { label: __('Top', 'my-theme'), value: 'start' },
              { label: __('Middle', 'my-theme'), value: 'center' },
              { label: __('Bottom', 'my-theme'), value: 'end' },
            ] }
            value={ verticalAlignment }
            onChange={ ( verticalAlignment ) => setAttributes( { verticalAlignment } ) }
          />
        </PanelBody>
      </InspectorControls>
      <BlockControls>
      <Toolbar>
        <ToolbarButton
          icon={ plus }
          label={ __( 'Add Column', 'my-theme' ) }
          onClick={ () => { addBlock( 'my-theme/column' ) } }
        />
      </Toolbar>
      </BlockControls>
      <div { ...blockProps }>
        <InnerBlocks
          allowedBlocks={ ALLOWED_BLOCKS }
          template={ BLOCKS_TEMPLATE }
          orientation="horizontal"
          renderAppender={ false }
        />
      </div>
    </>
  );
}

export default compose( [
  withDispatch( ( dispatch, ownProps, registry ) => ( {
    addBlock( blockType, attributes ) {
      const { clientId } = ownProps;
      const { replaceInnerBlocks } = dispatch( 'core/block-editor' );
      const { getBlocks } = registry.select( 'core/block-editor' );

      let innerBlocks = getBlocks( clientId );

      innerBlocks = [
        ...innerBlocks,
        ...[ createBlock( blockType, attributes ) ],
      ];

      replaceInnerBlocks( clientId, innerBlocks, false );
    }
  } )
) ] )( RowEdit );
