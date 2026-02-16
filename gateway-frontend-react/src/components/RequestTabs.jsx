import { useState } from "react";
import HeadersEditor from "./HeadersEditor";
import ParamsEditor from "./ParamsEditor";
import BodyEditor from "./BodyEditor";

const RequestTabs = ({ method, headers, setHeaders, params, setParams, body, setBody }) => {
  const [tab, setTab] = useState("headers");

  return (
    <div className="tabs">
      <div className="tab-bar">
        <button onClick={() => setTab("headers")}>Headers</button>
        <button onClick={() => setTab("params")}>Params</button>
        {method !== "GET" && <button onClick={() => setTab("body")}>Body</button>}
      </div>

      <div className="tab-content">
        {tab === "headers" && <HeadersEditor data={headers} setData={setHeaders} />}
        {tab === "params" && <ParamsEditor data={params} setData={setParams} />}
        {tab === "body" && <BodyEditor body={body} setBody={setBody} />}
      </div>
    </div>
  );
};

export default RequestTabs;
