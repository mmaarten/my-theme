import { Component } from '@wordpress/element';
import ServerSideRender from '@wordpress/server-side-render';
import { InspectorControls } from '@wordpress/block-editor';
import { Disabled } from '@wordpress/components';

class AbstractDynamicBlock extends Component {

  getInspectorControls() {
    return '';
  }

  render() {
    const { name, attributes } = this.props;

    return (
      <>
        <InspectorControls>
          { this.getInspectorControls() }
        </InspectorControls>
        <Disabled>
          <div className="my-theme-block-preview">
            <ServerSideRender block={ name } attributes={ attributes } />
          </div>
        </Disabled>
      </>
    );
  }
}

export default AbstractDynamicBlock;
