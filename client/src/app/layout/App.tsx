import { useState } from "react";
import Header from "./Header";
import { Container, CssBaseline, createTheme } from "@mui/material";
import { ThemeProvider } from "@emotion/react";
import { Outlet } from "react-router-dom";
import { ProductsToDeleteProvider } from "../context/ProductsToDeleteContext";

function App() {
  const [darkMode, setDarkMode] = useState(() => {
    const lsTheme = localStorage.getItem("theme");
    if (!lsTheme) {
      if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
      ) {
        return true;
      } else {
        return false;
      }
    } else {
      switch (lsTheme) {
        case "dark":
          return true;

        case "light":
          return false;

        default:
          return false;
      }
    }
  });
  const paletteType = darkMode ? "dark" : "light";
  const theme = createTheme({
    palette: {
      mode: paletteType,
      background: {
        default: darkMode ? "#121212" : "#eaeaea",
      },
    },
  });

  function changeDarkMode() {
    setDarkMode(!darkMode);

    darkMode
      ? localStorage.setItem("theme", "light")
      : localStorage.setItem("theme", "dark");
  }

  return (
    <ThemeProvider theme={theme}>
      <ProductsToDeleteProvider>
        <div className="App">
          <CssBaseline />
          <Header darkModeChecked={darkMode} checkDarkMode={changeDarkMode} />
          <Container sx={{ mt: 10 }}>
            <Outlet />
          </Container>
        </div>
      </ProductsToDeleteProvider>
    </ThemeProvider>
  );
}

export default App;
