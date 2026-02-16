import React, { useEffect, useState } from "react";
import { loadCollections } from "../api/gateway";

// const CollectionsSidebar = ({ onSelect }) => {
//   const [collections, setCollections] = useState([]);

//   useEffect(() => {
//     loadCollections().then(setCollections);
//   }, []);

//   return (
//     <div className="w-64 border-r h-full p-3 bg-gray-50">
//       <h2 className="font-bold mb-2">Collections</h2>

//       {collections.map((req) => (
//         <div key={req.id}
//           onClick={() => onSelect(req)}
//           className="border p-2 mb-2 rounded cursor-pointer hover:bg-gray-200">
//           <strong>{req.name}</strong>
//           <div className="text-xs">{req.method} {req.url}</div>
//         </div>
//       ))}
//     </div>
//   );
// };

// export default CollectionsSidebar;
const CollectionsSidebar = ({ onSelect }) => {
  const [collections, setCollections] = React.useState([]);

  React.useEffect(() => {
    fetch("http://localhost:8001/api/collections")
      .then(res => res.json())
      .then(setCollections);
  }, []);

  return (
    <div className="sidebar">
      <h2>Collections</h2>

      {collections.map(item => (
        <div
          key={item.id}
          className="collection-item"
          onClick={() => onSelect(item)}
        >
          <strong>{item.name}</strong><br />
          <small>{item.method} {item.url}</small>
        </div>
      ))}
    </div>
  );
};

export default CollectionsSidebar;

