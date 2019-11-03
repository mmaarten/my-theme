
const SampleSave = ( { ...props } ) => {
  const { attributes, className } = props;
  const { content } = attributes;

  return (
    <div className={ className }>
      { content }
    </div>
  );
};

export default SampleSave;
