import { __ } from '@wordpress/i18n';
import { PanelBody, RangeControl } from '@wordpress/components';
import { InspectorControls, useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { compose } from '@wordpress/compose';
import { withSelect } from '@wordpress/data';
import { get, assign } from 'lodash';
import { BreakpointToolbar } from '../../components';
import { getGridColumns } from '../../helpers';

const GRID_COLUMNS = getGridColumns();

const ColumnEdit = ( props ) => {
  const { attributes, setAttributes, hasChildBlocks } = props;
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
                  label={ __( 'Width', 'my-theme' ) }
                  value={ get( width, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      width : assign( {}, width, { [ breakpoint ] : value } )
                    } );
                  } }
                  min={ 1 }
                  max={ GRID_COLUMNS }
                  allowReset
                />
                <RangeControl
                  label={ __( 'Offset', 'my-theme' ) }
                  value={ get( offset, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      offset : assign( {}, offset, { [ breakpoint ] : value } )
                    } );
                  } }
                  min={ 1 }
                  max={ GRID_COLUMNS }
                  allowReset
                />
                <RangeControl
                  label={ __( 'Order', 'my-theme' ) }
                  value={ get( order, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      order : assign( {}, order, { [ breakpoint ] : value } )
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
