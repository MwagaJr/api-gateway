import React from "react";

const HeadersEditor = ({ data, setData }) => {
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
      <h3>Headers</h3>

      {data.map((row, i) => (
        <div className="kv-row" key={i}>
          <input
            placeholder="Key"
            value={row.key}
            onChange={(e) => update(i, "key", e.target.value)}
          />
          <input
            placeholder="Value"
            value={row.value}
            onChange={(e) => update(i, "value", e.target.value)}
          />
        </div>
      ))}

      <div className="add-btn" onClick={addRow}>
        + Add Header
      </div>
    </div>
  );
};

export default HeadersEditor;
