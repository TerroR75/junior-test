import { useEffect, useState } from "react";
import Loading from "../../layout/Loading";
import agent from "../../api/axiosAgent";
import ProductList from "./ProductList";

function HomePage() {
  const [loading, setLoading] = useState(true);
  const [data, setData] = useState([]);

  useEffect(() => {
    agent.Products.list()
      .then((products) => setData(products))
      .catch((error) => console.log(error))
      .finally(() => setLoading(false));
  }, []);

  if (loading) {
    return <Loading message={"Fetching products..."} />;
  }

  if (data.length === 0) {
    return <h3>"No products found."</h3>;
  }

  return <ProductList products={data} />;
}

export default HomePage;
