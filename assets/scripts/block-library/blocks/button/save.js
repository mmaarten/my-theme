import { RichText, useBlockProps } from '@wordpress/block-editor';
import { getButtonClasses } from './common';

export default ( props ) => {
  const { attributes } = props;
  const { text, link, linkTab, toggle } = attributes;

  const blockProps = useBlockProps.save();
  const buttonClasses = getButtonClasses( attributes );

  return (
    <div { ...blockProps }>
      <RichText.Content
        tagName="a"
        className={ buttonClasses }
        value={ text }
        href={ link ? link : undefined }
        target={ linkTab ? '_blank' : undefined }
        data-toggle={ toggle ? toggle : undefined }
        role="button"
      />
    </div>
  );
};
