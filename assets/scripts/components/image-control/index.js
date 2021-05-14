import { __ } from '@wordpress/i18n';
import { BaseControl, Button, Icon } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { get } from 'lodash';

const ALLOWED_MEDIA_TYPES = [ 'image' ];

const ImageControl = ( {
  image,
  size,
  onChange,
  ...baseControlProps
} ) => {

  const onSelect = ( attachment ) => {

    // Get thumbnail.

    let thumbnail = get( attachment.sizes, 'thumbnail' );

    if (! thumbnail) {
      thumbnail = get( attachment.sizes, 'full' );
    }

    // Get requested size.

    let requested = get( attachment.sizes, 'full' );

    if (size && get( attachment.sizes, size )) {
      requested = get( attachment.sizes, size );
    }

    // Callback.

    onChange( {
      id       : attachment.id,
      url      : requested.url,
      alt      : attachment.alt,
      caption  : attachment.caption,
      title    : attachment.title,
      width    : requested.width,
      height   : requested.height,
      thumbnail: thumbnail.url,
    } );
  };

  const onRemove = () => {
    onChange();
  };

  return (
    <BaseControl { ...baseControlProps }>
      { ! image && (
        <MediaUploadCheck fallback="">
          <MediaUpload
            onSelect={ onSelect }
            allowedTypes={ ALLOWED_MEDIA_TYPES }
            render={ ( { open } ) => (
              <div>
                <Button onClick={ open } isLink>
                    { __( 'Select Image', 'my-theme' ) }
                </Button>
              </div>
            ) }
            />
        </MediaUploadCheck>
      ) }
      { image && (
        <div className="my-theme-thumbnail">
          <img src={ get(image, 'thumbnail') } />
          <MediaUploadCheck fallback="">
            <MediaUpload
              onSelect={ onSelect }
              allowedTypes={ ALLOWED_MEDIA_TYPES }
              value={ get(image, 'id') }
              render={ ( { open } ) => (
                <div className="my-theme-thumbnail__actions">
                  <Button onClick={ open } className="my-theme-thumbnail__action">
                    <Icon icon="edit" />
                  </Button>
                  <Button onClick={ onRemove } className="my-theme-thumbnail__action">
                    <Icon icon="no" />
                  </Button>
                </div>
              ) }
            />
            </MediaUploadCheck>
          </div>
        ) }
    </BaseControl>
  );
};

export default ImageControl;
