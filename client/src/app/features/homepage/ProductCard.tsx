import {
  Card,
  CardHeader,
  Avatar,
  CardMedia,
  CardContent,
  Typography,
  CardActions,
  Button,
} from "@mui/material";
import { Link } from "react-router-dom";
import Product from "../../models/product";

interface Props {
  product: Product;
}

function ProductCard({ product }: Props) {
  return (
    <Card>
      <CardHeader
        avatar={
          <Avatar sx={{ bgcolor: "secondary.main" }}>
            {product.name.charAt(0).toUpperCase()}
          </Avatar>
        }
        title={product.name}
        titleTypographyProps={{
          sx: { fontWeight: "bold", color: "primary.main" },
        }}
      />
      <CardContent>
        <Typography color="secondary" gutterBottom variant="h6">
          ${(product.price / 100).toFixed(2)}
        </Typography>
        <Typography variant="body2" color="text.secondary">
          {product.type}
        </Typography>
      </CardContent>
      <CardActions>
        <Button component={Link} to={`/catalog/${product.id}`} size="small">
          Details
        </Button>
      </CardActions>
    </Card>
  );
}

export default ProductCard;
