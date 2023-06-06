import { ReactNode, createContext, useState } from "react";

export interface ProductInfo {
  id: string;
  type: string;
}

// Context for products ids to delete
interface ProductsToDeleteContextProps {
  productsToDelete: ProductInfo[];
  setProductsToDelete: React.Dispatch<React.SetStateAction<ProductInfo[]>>;
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
  const [productsToDelete, setProductsToDelete] = useState<ProductInfo[]>([]);

  return (
    <ProductsToDeleteContext.Provider
      value={{ productsToDelete, setProductsToDelete }}
    >
      {children}
    </ProductsToDeleteContext.Provider>
  );
};
