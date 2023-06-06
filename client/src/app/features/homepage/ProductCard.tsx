import {
  Card,
  CardHeader,
  Avatar,
  CardContent,
  Typography,
  CardActions,
  Button,
  Checkbox,
  FormControlLabel,
} from "@mui/material";
import { Link } from "react-router-dom";
import Product from "../../models/product";
import { useContext, useState } from "react";
import { ProductsToDeleteContext } from "../../context/ProductsToDeleteContext";

interface Props {
  product: Product;
}

function ProductCard({ product }: Props) {
  const [markedDelete, setMarkedDelete] = useState(false);
  const itemsToDeleteContext = useContext(ProductsToDeleteContext);

  function handleMarkForDeletion(
    e: any,
    dataset: { id: string; type: string }
  ) {
    setMarkedDelete(!markedDelete);

    if (!markedDelete) {
      const newArray = [
        ...itemsToDeleteContext.productsToDelete,
        { id: dataset.id, type: dataset.type },
      ];

      itemsToDeleteContext.setProductsToDelete(newArray);
    } else {
      const idToDelete = itemsToDeleteContext.productsToDelete.findIndex(
        (item) => item.id === dataset.id
      );
      console.log(idToDelete);
      let newArray = [...itemsToDeleteContext.productsToDelete];
      newArray.splice(idToDelete, 1);

      itemsToDeleteContext.setProductsToDelete([...newArray]);
    }
  }

  return (
    <Card sx={markedDelete ? { border: "1px dotted red" } : {}}>
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
      <CardActions sx={{ display: "flex", justifyContent: "space-between" }}>
        <Button component={Link} to={`/${product.id}`} size="small">
          Details
        </Button>
        <FormControlLabel
          control={
            <Checkbox className={"delete-checkbox"} checked={markedDelete} />
          }
          onChange={(e) =>
            handleMarkForDeletion(e, {
              id: product.id.toString(),
              type: product.type,
            })
          }
          label="Delete"
          sx={{ userSelect: "none" }}
        />
      </CardActions>
    </Card>
  );
}

export default ProductCard;
