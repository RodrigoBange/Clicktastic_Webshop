<?php
// Repository
require(__DIR__ . '/../repositories/ProductRepository.php');

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        try {
            $this->productRepository = new ProductRepository();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Retrieves a product by ID.
     */
    public function getProductById(int $id)
    {
        // Return product by ID
        $product = $this->productRepository->getProductById($id);

        if ($product != null) {
            return $product;
        }
        return null;
    }

    /**
     * Retrieves all products.
     */
    public function getAllProducts(): ?array
    {
        $products = $this->productRepository->getAllProducts();

        if ($products != null) {
            return $products;
        }
        return null;
    }

    /**
     * Retrieves the total product count.
     */
    public function getProductCount($keywords, $filters)
    {
        if (empty($keywords) && empty($filters)) { // If nothing is applied
            return $this->productRepository->getProductCount();
        } elseif (!empty($keywords) || !empty($filters)) { // If either or both is applied
            // Build query
            $query = $this->buildCountQuery($keywords, $filters);
            return $this->productRepository->getProductCountByKeywords($query, $keywords);
        }
    }

    private function buildCountQuery($keywords, $filters): string
    {
        if (!empty($keywords) || !empty($filters)) {
            // Build query
            $query = "SELECT COUNT(*) as total FROM products WHERE ";
            $query .= str_repeat(" name LIKE ? OR ", count($keywords));
            $query = substr($query, 0, -4); // Remove final OR
        }
        return $query;
    }

    private function buildWhereQuery($keywords, $filters): ?string
    {
        if (!empty($keywords) || !empty($filters)) {
            // Build query
            $query = "SELECT * FROM products WHERE ";
            $query .= str_repeat(" name LIKE ? OR ", count($keywords));
            $query = substr($query, 0, -4); // Remove final OR
            return $query;
        } else {
            return "SELECT * FROM products ";
        }
    }

    /**
     * Retrieves all products within limit.
     */
    public function getProductsByLimit(int $limit): ?array
    {
        $products = $this->productRepository->getProductsByLimit($limit);

        if ($products != null) {
            return $products;
        }
        return null;
    }

    /**
     * Retrieves all products within offset, limit and by where clause.
     */
    public function getProductsByOffsetLimit($keywords, $filters, int $offset, int $limit): ?array
    {
        $query = "";
        $query .= $this->buildWhereQuery($keywords, $filters);
        $values = array_merge($keywords, $filters);

        // Add order, offset and display limit
        $query .= " ORDER BY id DESC LIMIT " . $offset . " , " . $limit;

        // Get products
        $products = $this->productRepository->getProductsByOffsetLimit($query, $values);

        if ($products != null) {
            return $products;
        }
        return null;
    }

    /**
     * Retrieves the newest added products
     */
    public function getNewestProducts(): ?array
    {
        $products = $this->productRepository->getNewestProducts();

        if ($products != null) {
            return $products;
        }
        return null;
    }

    /**
     * Gets all cart products
     */
    public function getCartProducts() : array
    {
        $cartProducts = array();

        // Get cart products by ID of shopping cart products
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $product = $this->getProductById($value['product_id']);
                $cartProducts[] = $product;
            }
        }

        return $cartProducts;
    }

    /**
     * Gets the subtotal price of all items
     */
    public function getSubtotalPrice(): float|int
    {
        $subtotal = 0;

        // Calculate subtotal by quantity * price of each added product
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $subtotal += $value['product_quantity'] * $value['product_price'];
            }
        }

        return number_format($subtotal,2);
    }

    /**
     * Gets the total price of all items and extra costs
     */
    public function getTotalPrice(): float|int
    {
        // Calculate subtotal plus shipping cost
        return number_format($this->getSubtotalPrice() + $this->getShippingCost(), 2);
    }

    /**
     * Gets the shipping cost price
     */
    public function getShippingCost(): float|int
    {
        // Returns formatted shipping cost
        return number_format(5.99, 2);
    }

    /**
     * Gets all products of a specific order
     */
    public function getProductsOfOrder(int $id): array|null
    {
        return $this->productRepository->getProductsOfOrder($id);
    }

    /**
     * Gets products by a custom filter
     */
    public function getFilteredProducts()
    {
        if (isset($_POST['page'])) {
            // Configuration
            $offset = !empty($_POST['page'])?$_POST['page'] : 0;
            $limit = 6;
            $keywords = array();
            $filters = array();

            // Search conditions
            if (!empty($_POST['keywords'])) {
                // Filter and explode sentence
                $keywordsList = htmlspecialchars($_POST['keywords']);
                $keywordsList = trim($keywordsList);
                $keywords = preg_split('/\s+/', $keywordsList);

                // Literal string
                foreach ($keywords as $keyword => $value) {
                    $keywords[$keyword] = "%" . $value . "%";
                }
            }

            // Fetch records based on the offset and limit
            return $this->getProductsByOffsetLimit($keywords, $filters, $offset, $limit);
        }
    }

    /**
     * Creates the pagination fitting with the filter
     */
    public function getFilterPagination()
    {
        if (isset($_POST['page'])) {
            // Configuration
            $baseURL = __DIR__ . "/../views/shop/getproducts.php";
            $offset = !empty($_POST['page'])?$_POST['page'] : 0;
            $limit = 6;
            $keywords = array();
            $filters = array();

            // Search conditions
            if (!empty($_POST['keywords'])) {
                // Filter and explode sentence
                $keywordsList = htmlspecialchars($_POST['keywords']);
                $keywordsList = trim($keywordsList);
                $keywords = preg_split('/\s+/', $keywordsList);

                // Literal string
                foreach ($keywords as $keyword => $value) {
                    $keywords[$keyword] = "%" . $value . "%";
                }
            }

            // Count all records
            $rowCount = $this->getProductCount($keywords, $filters);

            // Initialize Pagination class
            $pagConfig = array(
                'baseURL' => $baseURL,
                'totalRows' => $rowCount,
                'perPage' => $limit,
                'currentPage' => $offset,
                'contentDiv' => 'dataContainer',
                'link_func' => 'searchFilter'
            );
            return new Pagination($pagConfig);
        }
    }
}
