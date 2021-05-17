import { __ } from '@wordpress/i18n';
import { PanelBody, TextControl } from '@wordpress/components';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { Disabled } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

export default ( props ) => {
  const { name, attributes, setAttributes } = props;
  const { attribute } = attributes;
  const blockProps = useBlockProps();

  return (
    <div { ...blockProps }>
      <InspectorControls>
        <PanelBody initialOpen={ true }>
          <TextControl
            label={ __( 'Attribute', 'my-theme' ) }
            value={ attribute }
            onChange={ ( attribute ) => setAttributes( { attribute } ) }
          />
        </PanelBody>
      </InspectorControls>
      <Disabled>
        <div class="my-theme-block-preview">
          <ServerSideRender block={ name } attributes={ attributes } />
        </div>
      </Disabled>
    </div>
  );
}
