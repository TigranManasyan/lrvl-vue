import ProductsTable from "./ProductsTable";
import CreateProduct from "./CreateProduct";
export default [
    {path: "/products", name: "Table", component: ProductsTable},
    {path: "/products/create", name: "CreateProduct", component: CreateProduct}
]
