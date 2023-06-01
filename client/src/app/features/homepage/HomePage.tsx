import { CircularProgress } from "@mui/material";
import { useEffect, useState } from "react";
import Loading from "../../layout/Loading";
import axios from "axios";

function HomePage() {
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios
      .get("/user?ID=12345")
      .then(function (response) {
        // handle success
        console.log(response);
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      })
      .finally(function () {
        // always executed
      });
  }, []);

  if (loading) {
    return <Loading message={"Fetching products..."} />;
  }

  return <>Home page</>;
}

export default HomePage;
