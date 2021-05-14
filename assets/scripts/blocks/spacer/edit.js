import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { get, assign } from 'lodash';
import { BreakpointToolbar } from '../../components';
import { getClasses } from './common';

export default ( props ) => {
  const { attributes, setAttributes } = props;
  const { sizes } = attributes;

  const blockProps = useBlockProps({
    className: getClasses( attributes ),
    'aria-hidden': 'true',
  });

  return (
    <>
      <InspectorControls>
        <PanelBody initialOpen={ true }>
          <BreakpointToolbar
            onChange={ ( breakpoint ) => {

              console.log( breakpoint, get( sizes, breakpoint ) );
              let options = [
                { label: __( 'Small', 'my-theme' ), value: 3 },
                { label: __( 'Medium', 'my-theme' ), value: 4 },
                { label: __( 'Large', 'my-theme' ), value: 5 },
              ];

              if ( 'xs' !== breakpoint ) {
                options = [
                  { label: __( '- Inherit from smaller -', 'my-theme' ), value: '' },
                  ...options
                ];
              }

              return (
                <SelectControl
                  label={ __( 'Size', 'my-theme' ) }
                  options={ options }
                  value={ get( sizes, breakpoint, '' ) }
                  onChange={ ( value ) => {
                    setAttributes( {
                      sizes: assign( {}, sizes, { [ breakpoint ]: value } )
                    } );
                  } }
                />
              );
             } }
          />
        </PanelBody>
      </InspectorControls>
      <div { ...blockProps } />
    </>
  );
};
