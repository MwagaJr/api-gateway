import React, { useState } from "react";
import Sidebar from "./Sidebar";
import RequestTabs from "./RequestTabs";
import ResponseViewer from "./ResponseViewer";
import { sendRequest, saveRequest } from "../api/gateway";

const ApiTester = () => {
  const [method, setMethod] = useState("GET");
  const [url, setUrl] = useState("");
  const [headers, setHeaders] = useState([{ key: "", value: "" }]);
  const [params, setParams] = useState([{ key: "", value: "" }]);
  const [body, setBody] = useState("{}");
  const [response, setResponse] = useState(null);
  const [history, setHistory] = useState([]);

  const sendApi = async () => {
    try {
      const payload = {
        method,
        url,
        headers: toObject(headers),
        query_params: toObject(params),
        body: method === "GET" ? null : JSON.parse(body),
      };

      const result = await sendRequest(payload);
      setResponse(result);

      setHistory([{ method, url }, ...history]);
    } catch (err) {
      setResponse({ error: err.message });
    }
  };

  const toObject = (arr) => {
    let obj = {};
    arr.forEach(i => i.key && (obj[i.key] = i.value));
    return obj;
  };

  return (
    <div className="layout">
      <Sidebar history={history} />

      <div className="main">
        <div className="request-bar">
          <select value={method} onChange={e => setMethod(e.target.value)}>
            <option>GET</option>
            <option>POST</option>
            <option>PUT</option>
            <option>DELETE</option>
          </select>

          <input
            placeholder="https://api.example.com"
            value={url}
            onChange={e => setUrl(e.target.value)}
          />

          <button className="btn btn-send" onClick={sendApi}>Send</button>
        </div>

        <RequestTabs
          method={method}
          headers={headers} setHeaders={setHeaders}
          params={params} setParams={setParams}
          body={body} setBody={setBody}
        />

        <ResponseViewer response={response} />
      </div>
    </div>
  );
};

export default ApiTester;
