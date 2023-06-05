import { ReactNode, createContext, useState } from "react";

// Context for products ids to delete
interface ProductsToDeleteContextProps {
  productsToDelete: number[];
  setProductsToDelete: React.Dispatch<React.SetStateAction<number[]>>;
}

interface ProductsToDeleteProviderProps {
  children: ReactNode;
}

export const ProductsToDeleteContext =
  createContext<ProductsToDeleteContextProps>({
    productsToDelete: [],
    setProductsToDelete: () => {},
  });

export const ProductsToDeleteProvider: React.FC<
  ProductsToDeleteProviderProps
> = ({ children }) => {
  const [productsToDelete, setProductsToDelete] = useState<number[]>([]);

  return (
    <ProductsToDeleteContext.Provider
      value={{ productsToDelete, setProductsToDelete }}
    >
      {children}
    </ProductsToDeleteContext.Provider>
  );
};
