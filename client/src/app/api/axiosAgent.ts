import axios, { AxiosResponse } from "axios";
import { ProductInfo } from "../context/ProductsToDeleteContext";

axios.defaults.baseURL = "http://localhost/junior-test/api";

const delay = (ms: number) => new Promise((resolve) => setTimeout(resolve, ms));

const responseBody = (response: AxiosResponse) => response.data;

axios.interceptors.response.use(async (response) => {
  await delay(10);
  return response;
});

const requests = {
  get: (url: string) => axios.get(url).then(responseBody),
  post: (url: string, body: {}) => axios.post(url, body).then(responseBody),
  put: (url: string, body: {}) => axios.put(url, body).then(responseBody),
  delete: (url: string, body: {}) => axios.delete(url, body).then(responseBody),
};

const Products = {
  list: () => requests.get("products"),
  deleteSelected: (productArray: any) =>
    requests.delete("products/deleteAll", productArray),
};

const Books = {
  list: () => requests.get("books"),
  //   details: (id: number) => requests.get(`products/${id}`),
};

const agent = {
  Products,
  Books,
};

export default agent;
