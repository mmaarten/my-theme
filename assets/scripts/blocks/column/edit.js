import { __ } from '@wordpress/i18n';
import { PanelBody, RangeControl } from '@wordpress/components';
import { InspectorControls, InnerBlocks, blockProps } from '@wordpress/block-editor';
import { compose } from '@wordpress/compose';
import { withSelect } from '@wordpress/data';
import { get, assign } from 'lodash';
import { BreakpointToolbar } from '../../components';

const GRID_COLUMNS = 12;

const ColumnEdit = ( props ) => {
  const { attributes, setAttributes, className, hasChildBlocks } = props;
  const { width, offset, order } = attributes;

  const blockProps = useBlockProps();

  return (
    <>
      <InspectorControls>
        <PanelBody initialOpen={ true }>
          <BreakpointToolbar
            onChange={ ( breakpoint ) => (
              <>
                <RangeControl
                  label={ __( 'Width' ) }
                  value={ get( width, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      width: assign( {}, width, { [ breakpoint ]: value } )
                    } );
                  } }
                  min={ 1 }
                  max={ GRID_COLUMNS }
                  allowReset
                />
                <RangeControl
                  label={ __( 'Offset' ) }
                  value={ get( offset, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      offset: assign( {}, offset, { [ breakpoint ]: value } )
                    } );
                  } }
                  min={ 1 }
                  max={ GRID_COLUMNS }
                  allowReset
                />
                <RangeControl
                  label={ __( 'Order' ) }
                  value={ get( order, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      order: assign( {}, order, { [ breakpoint ]: value } )
                    } );
                  } }
                  min={ 1 }
                  max={ GRID_COLUMNS }
                  allowReset
                />
              </>
            ) }
          />
        </PanelBody>
      </InspectorControls>
      <div { ...blockProps }>
        <InnerBlocks
          templateLock={ false }
          renderAppender={ (
            // Show appender when no inner blocks.
            hasChildBlocks ? undefined : () => <InnerBlocks.ButtonBlockAppender />
          ) }
        />
      </div>
    </>
  );
}

export default compose(
	withSelect( ( select, ownProps ) => {
		const { clientId } = ownProps;
		const { getBlockOrder } = select( 'core/block-editor' );

    return {
			hasChildBlocks: getBlockOrder( clientId ).length > 0,
		};
	} ),
)( ColumnEdit );
