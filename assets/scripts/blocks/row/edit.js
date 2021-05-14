import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { PanelBody, SelectControl, ToggleControl, Toolbar } from '@wordpress/components';
import { InspectorControls, InnerBlocks, BlockControls, useBlockProps } from '@wordpress/block-editor';
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { createBlock } from '@wordpress/blocks';
import classnames from 'classnames';

const ALLOWED_BLOCKS = [ 'my/column' ];
const BLOCKS_TEMPLATE = [ [ 'my/column' ], [ 'my/column' ] ];

class RowEdit extends Component {

  render() {
    const { attributes, setAttributes, addBlock } = this.props;
    const { container, noGutters, verticalAlignment } = attributes;

    const blockProps = useBlockProps({
      className : classnames( {
        'has-no-gutters': noGutters,
        [`has-${container}-container`]: container,
        [`has-align-items-${verticalAlignment}`] : verticalAlignment,
      } ),
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
          <Toolbar controls={
            [
              {
                icon: 'plus',
                title: __( 'Add Column' ),
          			isActive: false,
          			onClick: () => { addBlock( 'my/column' ) }
              }
            ]
          }
          />
        </BlockControls>
        <div { ...blockProps }>
          <InnerBlocks
            allowedBlocks={ ALLOWED_BLOCKS }
            template={ BLOCKS_TEMPLATE }
            __experimentalMoverDirection="horizontal"
            __experimentalTagName="div"
            renderAppender={ false }
            />
        </div>
      </>
    );
  }
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
