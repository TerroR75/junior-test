import {
  AppBar,
  Toolbar,
  IconButton,
  Typography,
  Box,
  FormControlLabel,
  List,
  ListItem,
  Switch,
  Button,
} from "@mui/material";
import { NavLink } from "react-router-dom";

interface Props {
  darkModeChecked: boolean;
  checkDarkMode: () => void;
}

const centerLinks = [{ title: "add", path: "/add" }];

const navStyles = {
  textDecoration: "none",
  color: "inherit",
  typography: "h6",
  "&:hover": { color: "grey.500" },
  "&.active": { color: "text.secondary" },
};

function Header({ darkModeChecked, checkDarkMode }: Props) {
  return (
    <AppBar position="fixed">
      <Toolbar
        sx={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "center",
        }}
      >
        <Box display="flex" alignItems="center" gap={2}>
          <Typography component={NavLink} to="/" variant="h6" sx={navStyles}>
            Home
          </Typography>
          <FormControlLabel
            control={
              <Switch
                color="default"
                checked={darkModeChecked}
                onChange={checkDarkMode}
              />
            }
            label="Dark Mode"
          />
        </Box>

        <List sx={{ display: "flex" }}>
          {centerLinks.map(({ title, path }) => (
            <ListItem component={NavLink} to={path} key={path} sx={navStyles}>
              {title.toUpperCase()}
            </ListItem>
          ))}
          <ListItem sx={navStyles}>
            <Button
              id="delete-product-btn"
              variant="contained"
              color="error"
              sx={{ color: "black", width: "140px" }}
            >
              Mass Delete
            </Button>
          </ListItem>
        </List>
      </Toolbar>
    </AppBar>
  );
}

export default Header;
