import { __ } from '@wordpress/i18n';
import { withSelect } from '@wordpress/data';
import { compose } from '@wordpress/compose';
import { SelectControl } from '@wordpress/components';
import { map } from 'lodash';

const PostControl = ( props ) => {
  const { posts, post, postType, ...controlProps } = props;

  let options = [
    { value: 0, label: __( '- Select -', 'my-theme' ) },
  ];
  map( posts, ( post ) => {
    options = [ ...options, { value: post.id, label: post.title.rendered } ];
  } );

  return (
    <SelectControl
      { ...controlProps }
      options={ options }
      value={ post }
    />
  );
};

export default compose(
  withSelect( ( select, ownProps ) => {
    const { postType } = ownProps;
    return {
			posts: select( 'core' ).getEntityRecords( 'postType', postType ? postType : 'post' ),
		}
  }),
)( PostControl );
