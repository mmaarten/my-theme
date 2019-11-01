import { BaseControl } from '@wordpress/components';
import { URLInput } from '@wordpress/block-editor';
import { withInstanceId } from '@wordpress/compose';

const URLControl = ( {
  label,
  hideLabelFromVision,
  value,
  help,
  className,
  instanceId,
  ...otherProps
} ) => {
	const id = `inspector-url-control-${ instanceId }`;

	return (
		<BaseControl
      label={ label }
      hideLabelFromVision={ hideLabelFromVision }
      id={ id }
      help={ help }
      className={ className }
    >
      <URLInput
        className="my-url-control__input"
        id={ id }
        value={ value }
        autoFocus={ false }
        hasBorder
        { ...otherProps }
      />
		</BaseControl>
	);
}

export default withInstanceId( URLControl );
