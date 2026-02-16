const Sidebar = ({ history }) => {
  return (
    <div className="sidebar">
      <h3>History</h3>

      {history.map((item, i) => (
        <div key={i} className="history-item">
          <strong>{item.method}</strong>
          <div className="url">{item.url}</div>
        </div>
      ))}
    </div>
  );
};

export default Sidebar;
