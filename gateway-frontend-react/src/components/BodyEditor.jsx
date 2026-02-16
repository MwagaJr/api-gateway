import React from "react";

const BodyEditor = ({ body, setBody }) => {
  return (
    <div className="section">
      <h3>Body (JSON)</h3>
      <textarea
        value={body}
        onChange={(e) => setBody(e.target.value)}
      />
    </div>
  );
};

export default BodyEditor;
