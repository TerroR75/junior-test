import { Grid } from "@mui/material";
import Product from "../../models/product";
import ProductCard from "./ProductCard";
import Book from "../../models/book";

interface Props {
  products: Book[];
}

function ProductList({ products }: Props) {
  console.log(products);
  return (
    <Grid container spacing={4}>
      {products.map((product: Product) => {
        return (
          <Grid item xs={3} key={product.id}>
            <ProductCard product={product} />
          </Grid>
        );
      })}
    </Grid>
  );
}

export default ProductList;
