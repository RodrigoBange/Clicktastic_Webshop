<?php
// Service
require_once(__DIR__ . '/../services/ProductService.php');

// Model
require_once(__DIR__ . '/../models/Pagination.php');
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class ShopController
{
    private ProductService $productService;
    private NavbarFunctions $navFunc;
    private string $page;

    public function __construct()
    {
        // Initialize
        $this->productService = new ProductService();
        $this->navFunc = new NavbarFunctions();
        $this->page = 'shop';
    }

    /**
     * Loads the products page
     */
    public function products(): void
    {
        // Set up Pagination settings
        $baseURL = __DIR__ . '/../views/shop/getproducts.php';
        // Get product count for row count
        $rowCount = $this->productService->getProductCount(null, null);
        $limit = 6;

        $pagConfig = array(
            'baseUrl' => $baseURL,
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'contentDiv' => 'dataContainer',
            'link_func' => 'searchFilter'
        );
        $pagination = new Pagination($pagConfig);

        // Fetch records based on the limit
        $productResults = $this->productService->getProductsByLimit($limit);

        // Fetch all unique company names
        $companies = $this->productService->getCompanies();

        // Navigation functions
        $navFunc = $this->navFunc;
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . '/../views/shop/products.php');
    }

    /**
     * Loads a specific product page
     */
    public function product(): void
    {
        if (isset($_GET['id'])) {
            // Get product to display
            $product = $this->productService->getProductById($_GET['id']);
        } else {
            $product = null;
        }

        // Get the newest products to display
        $newestProducts = $this->productService->getNewestProducts();

        // Navigation functions
        $navFunc = $this->navFunc;
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . '/../views/shop/product.php');
    }

    /**
     * AJAX, loads products by search and filter data
     */
    public function getproducts(): void
    {
        // Get filtered products
        $filteredProducts = $this->productService->getFilteredProducts();

        // Get pagination
        $pagination = $this->productService->getFilterPagination();

        // Load the view
        require_once(__DIR__ . '/../views/shop/getproducts.php');
    }
}
