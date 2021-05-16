import { __ } from '@wordpress/i18n';
import { BaseControl } from '@wordpress/components';
import { URLInput } from '@wordpress/block-editor';

const URLControl = ( {
  value,
  onChange,
  ...baseControlProps
} ) => {

  return (
    <BaseControl { ...baseControlProps }>
      <URLInput
				className="my-theme-url-input"
				value={ value }
				onChange={ onChange }
			/>
    </BaseControl>
  );
};

export default URLControl;
