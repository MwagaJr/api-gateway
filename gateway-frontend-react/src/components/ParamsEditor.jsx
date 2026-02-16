import React from "react";

const ParamsEditor = ({ data, setData }) => {
  const update = (index, field, value) => {
    const copy = [...data];
    copy[index][field] = value;
    setData(copy);
  };

  const addRow = () => {
    setData([...data, { key: "", value: "" }]);
  };

  return (
    <div className="section">
      <h3>Query Params</h3>

      {data.map((row, index) => (
        <div className="kv-row" key={index}>
          <input
            placeholder="Key"
            value={row.key}
            onChange={(e) => update(index, "key", e.target.value)}
          />
          <input
            placeholder="Value"
            value={row.value}
            onChange={(e) => update(index, "value", e.target.value)}
          />
        </div>
      ))}

      <div className="add-btn" onClick={addRow}>
        + Add Param
      </div>
    </div>
  );
};

export default ParamsEditor;
