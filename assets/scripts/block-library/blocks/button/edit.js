import { __ } from '@wordpress/i18n';
import { RichText, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, SelectControl } from '@wordpress/components';
import { getButtonClasses } from './common';
import { URLControl } from '../../components';
import { getConfig } from '../../helpers';

export default ( props ) => {
  const { attributes, setAttributes } = props;
  const { text, link, linkTab, type, outline, size, block, toggle } = attributes;

  const blockProps = useBlockProps();
  const buttonClasses = getButtonClasses( attributes );

  return (
    <>
      <InspectorControls>
        <PanelBody title={ __( 'Link Settings', 'my-theme' ) } initialOpen={ true }>
          <URLControl
            label={ __( 'Link', 'my-theme' ) }
            value={ link }
            onChange={ ( link ) => setAttributes( { link } ) }
          />
          <ToggleControl
            label={ __( 'Open in new window', 'my-theme' ) }
            checked={ linkTab }
            onChange={ ( linkTab ) => setAttributes( { linkTab } ) }
          />
        </PanelBody>
        <PanelBody title={ __( 'Style Settings', 'my-theme' ) } initialOpen={ false }>
          <SelectControl
            label={ __( 'Type', 'my-theme' ) }
            options={ getConfig( 'themeColors' ) }
            value={ type }
            onChange={ ( type ) => setAttributes( { type } ) }
          />
          <ToggleControl
            label={ __( 'Outline', 'my-theme' ) }
            checked={ outline }
            onChange={ ( outline ) => setAttributes( { outline } ) }
          />
          <SelectControl
            label={ __( 'Size', 'my-theme' ) }
            options={ [
							{ label: __( 'Small', 'my-theme' ), value: 'sm' },
              { label: __( 'Medium', 'my-theme' ), value: '' },
              { label: __( 'Large', 'my-theme' ), value: 'lg' },
						] }
            value={ size }
            onChange={ ( size ) => setAttributes( { size } ) }
          />
          <ToggleControl
            label={ __( 'Full Width', 'my-theme' ) }
            checked={ block }
            onChange={ ( block ) => setAttributes( { block } ) }
          />
        </PanelBody>
        <PanelBody title={ __( 'Toggle Settings', 'my-theme' ) } initialOpen={ false }>
          <SelectControl
            label={ __( 'Toggle', 'my-theme' ) }
            options={ [
              { label: __( '- Select -', 'my-theme' ), value: '' },
							{ label: __( 'Modal', 'my-theme' ), value: 'modal' },
              { label: __( 'Collapse', 'my-theme' ), value: 'collapse' },
						] }
            value={ toggle }
            onChange={ ( toggle ) => setAttributes( { toggle } ) }
          />
        </PanelBody>
      </InspectorControls>
      <div { ...blockProps }>
        <RichText
          tagName="span"
          className={ buttonClasses }
          value={ text }
          onChange={ ( text ) => setAttributes( { text } ) }
          placeholder={ __( 'Button text...', 'my-theme' ) }
          allowedFormats={ [] }
          withoutInteractiveFormatting
        />
      </div>
    </>
  );
};
