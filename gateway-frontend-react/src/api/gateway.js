import axios from "axios";

export const sendRequest = async (payload) => {
  const res = await axios.post("http://localhost:8000/api/gateway/send", payload);
  return res.data;
};

export const saveRequest = async (payload) => {
  const res = await axios.post("http://localhost:8000/api/collections/save", payload);
  return res.data;
};

export const loadCollections = async () => {
  const res = await axios.get("http://localhost:8000/api/collections");
  return res.data;
};
