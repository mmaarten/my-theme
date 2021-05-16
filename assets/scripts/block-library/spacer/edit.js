import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { get, assign } from 'lodash';
import { BreakpointToolbar } from '../../components';
import { getSpacerClasses } from './common';
import { getSelectOptions, getSetting } from '../../helpers';

export default ( props ) => {
  const { attributes, setAttributes } = props;
  const { sizes } = attributes;

  const blockProps = useBlockProps({
    className: getSpacerClasses( attributes ),
    'aria-hidden': 'true',
  });

  const sizeOptions = [
    { label: __( 'Small', 'my-theme' ), value: 3 },
    { label: __( 'Medium', 'my-theme' ), value: 4 },
    { label: __( 'Large', 'my-theme' ), value: 5 },
  ];

  return (
    <>
      <InspectorControls>
        <PanelBody initialOpen={ true }>
          <BreakpointToolbar
            onChange={ ( breakpoint ) => {

              let options = [ ...sizeOptions ];

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
