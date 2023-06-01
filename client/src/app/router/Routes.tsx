import { createBrowserRouter, Navigate } from "react-router-dom";
import App from "../layout/App";
import AddPage from "../features/addpage/AddPage";
import NotFoundPage from "../features/notfoundpage/NotFoundPage";
import HomePage from "../features/homepage/HomePage";

export const router = createBrowserRouter([
  {
    path: "/",
    element: <App />,
    children: [
      { path: "", element: <HomePage /> },
      { path: "add", element: <AddPage /> },
      { path: "not-found", element: <NotFoundPage /> },
      { path: "*", element: <Navigate replace to="/not-found" /> },
    ],
  },
]);
