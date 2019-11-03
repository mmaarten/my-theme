import {
  __,
} from '@wordpress/i18n';
import {
  Component,
} from '@wordpress/element';
import {
	PanelBody,
	TextControl,
} from '@wordpress/components';
import {
  InspectorControls,
} from '@wordpress/block-editor';

class SampleEdit extends Component {
  constructor() {
    super( ...arguments );
  }
  render() {
    const { attributes, setAttributes, className } = this.props;
    const { content } = attributes;

    return (
      <>
        <InspectorControls>
          <PanelBody title={ __( 'Sample Settings', 'my-theme' ) } initialOpen={ true }>
            <TextControl
              label={ __( 'Content', 'my-theme' ) }
              value={ content }
              onChange={ ( value ) => setAttributes( { content : value } ) }
            />
          </PanelBody>
        </InspectorControls>
        <div className={ className }>
          { content }
        </div>
      </>
    );
  }
}

export default SampleEdit;
