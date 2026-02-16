export const applyEnv = (text, env) => {
  return text.replace(/\{\{(.*?)\}\}/g, (_, key) => env[key] || "");
};
