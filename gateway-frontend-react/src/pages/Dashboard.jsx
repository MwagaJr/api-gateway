import { useState } from "react";
import ApiTester from "../components/ApiTester";
import CollectionsSidebar from "../components/CollectionsSidebar";
import "../App.css";

const Dashboard = () => {
  const [loadedReq, setLoadedReq] = useState(null);

  return (
    <div className="app-container">
      <CollectionsSidebar onSelect={setLoadedReq} />
      <div className="main">
        <ApiTester loadedReq={loadedReq} />
      </div>
    </div>
  );
};

export default Dashboard;
