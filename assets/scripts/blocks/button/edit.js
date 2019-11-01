import {
  __,
} from '@wordpress/i18n';
import {
  Component,
} from '@wordpress/element';
import {
	PanelBody,
	SelectControl,
	ToggleControl,
	TextControl,
  Toolbar,
  ColorPalette,
} from '@wordpress/components';
import {
  InspectorControls,
  BlockControls,
  AlignmentToolbar,
  RichText,
  getColorObjectByColorValue,
  getColorObjectByAttributeValues,
} from '@wordpress/block-editor';
import { withSelect } from '@wordpress/data';
import { compose } from '@wordpress/compose';
import {
  get,
} from 'lodash';
import
  classnames
  from 'classnames';
import {
	URLControl,
} from './../../editor-components';

const REL_TAB = 'noreferrer noopener';

class ButtonEdit extends Component {
  constructor() {
    super( ...arguments );

    this.handleLinkTabChange = this.handleLinkTabChange.bind( this );
    this.handleColorChange = this.handleColorChange.bind( this );
  }

  handleLinkTabChange( isChecked ) {
    const { attributes, setAttributes } = this.props;
    const { rel } = attributes;

    let updateAttributes = {
      linkTab : isChecked,
    };

    if ( isChecked ) {
      if (! rel) updateAttributes.rel = REL_TAB;
    } else if ( REL_TAB === rel ) {
      updateAttributes.rel = '';
    }

    setAttributes( updateAttributes );
  }

  handleColorChange( color ) {
    const { setAttributes, colors } = this.props;
    const colorObject = getColorObjectByColorValue( colors, color );
    const slug = get( colorObject, 'slug', 'primary' );

    setAttributes( { type : slug } );
  }

  render() {
    const {
      attributes,
      setAttributes,
      className,
      colors,
    } = this.props;

    const {
      text,
      link,
      linkTab,
      type,
      size,
      outline,
      toggle,
      rel,
      textAlign,
    } = attributes;

    const { color } = getColorObjectByAttributeValues( colors, type );

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __( 'Color Settings', 'my-theme' ) } initialOpen={ false }>
            <ColorPalette
              colors={ colors }
              value={ color }
              onChange={ this.handleColorChange }
              disableCustomColors={ true }
              clearable={ false }
            />
            <ToggleControl
              label={ __( 'Outline', 'my-theme' ) }
              checked={ outline }
              onChange={ ( outline ) => setAttributes( { outline } ) }
            />
          </PanelBody>
          <PanelBody title={ __( 'Size Settings', 'my-theme' ) } initialOpen={ false }>
            <SelectControl
              value={ size }
              onChange={ ( size ) => setAttributes( { size } ) }
              options={ [
                { label: __( 'Small', 'my-theme' ), value: 'sm' },
                { label: __( 'Normal', 'my-theme' ), value: '' },
                { label: __( 'Large', 'my-theme' ), value: 'lg' },
              ] }
            />
          </PanelBody>
          <PanelBody title={ __( 'Link Settings', 'my-theme' ) } initialOpen={ false }>
            <URLControl
              label={ __( 'Link', 'my-theme' ) }
              value={ link }
              onChange={ ( link ) => setAttributes( { link } ) }
            />
            <ToggleControl
              label={ __( 'Open in new tab', 'my-theme' ) }
              checked={ linkTab }
              onChange={ this.handleLinkTabChange }
            />
            <TextControl
              label={ __( 'Link rel', 'my-theme' ) }
              value={ rel }
              onChange={ ( rel ) => setAttributes( { rel } ) }
            />
            <SelectControl
              label={ __( 'Toggle', 'my-theme' ) }
              value={ toggle }
              onChange={ ( toggle ) => setAttributes( { toggle } ) }
              options={ [
                { label: __( '- None -', 'my-theme' ), value: null },
                { label: __( 'Modal', 'my-theme' ), value: 'modal' },
                { label: __( 'Collapse', 'my-theme' ), value: 'collapse' },
              ] }
            />
          </PanelBody>
        </InspectorControls>
        <BlockControls>
          <AlignmentToolbar
            value={ textAlign }
            onChange={ ( value ) => setAttributes( { textAlign: value } ) }
          />
        </BlockControls>
        <div
          className={ classnames( {
            [ className ]: className,
            [ `has-text-align-${ textAlign }` ]: textAlign,
          } ) }
        >
          <span
            className={ classnames(
              'btn', {
                [`btn-${ type }`]: type && ! outline,
                [`btn-outline-${ type }`]: type && outline,
                [`btn-${ size }`]: size,
              }
            ) }
          >
            <RichText
      				placeholder={ __( 'Add text…', 'my-theme' ) }
      				value={ text }
      				onChange={ ( text ) => setAttributes( { text } ) }
      				withoutInteractiveFormatting
      			/>
          </span>
        </div>
      </>
    );
  }
}

export default compose( [
	withSelect( ( select ) => {
		const { getSettings } = select( 'core/block-editor' );
    const { colors } = getSettings();
		return {
			colors,
		};
	} ),
] )( ButtonEdit );
