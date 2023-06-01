import axios, { AxiosResponse } from "axios";

axios.defaults.baseURL = "http://localhost/junior-test/api";

const delay = (ms: number) => new Promise((resolve) => setTimeout(resolve, ms));

const responseBody = (response: AxiosResponse) => response.data;

axios.interceptors.response.use(async (response) => {
  await delay(1000);
  return response;
});

const requests = {
  get: (url: string) => axios.get(url).then(responseBody),
  post: (url: string, body: {}) => axios.post(url, body).then(responseBody),
  put: (url: string, body: {}) => axios.put(url, body).then(responseBody),
  delete: (url: string) => axios.delete(url).then(responseBody),
};

const Books = {
  list: () => requests.get("books"),
  //   details: (id: number) => requests.get(`products/${id}`),
};

const agent = {
  Books,
};

export default agent;
