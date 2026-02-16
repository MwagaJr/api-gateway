import React from "react";

const ResponseViewer = ({ response }) => (
  <div className="section">
    <h3>Response</h3>
    <pre className="response">
      {response ? JSON.stringify(response, null, 2) : "No response yet"}
    </pre>
  </div>
);

export default ResponseViewer;
