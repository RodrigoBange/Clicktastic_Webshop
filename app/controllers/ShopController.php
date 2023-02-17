<?php
// Service
require_once(__DIR__ . "/../services/ProductService.php");

// Model
require_once(__DIR__ . "/../models/Pagination.php");
require_once(__DIR__ . "/../models/NavbarFunctions.php");


class ShopController
{
    private $productService;
    private $navFunc;

    public function __construct()
    {
        // Initialize
        $this->productService = new ProductService();
        $this->navFunc = new NavbarFunctions();
    }

    /**
     * Loads the products page
     */
    public function products(): void
    {
        // Set up Pagination settings
        $baseURL = __DIR__ . "/../views/shop/getdata.php";
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

        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/shop/products.php");
    }

    /**
     * Loads a specific product page
     */
    public function product(): void
    {
        // Service
        $productService = $this->productService;

        $products = $this->productService->getNewestProducts();

        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/shop/product.php");
    }

    /**
     * AJAX page, loads products by search and filter data
     */
    public function getData(): void
    {
        // Service
        $productService = $this->productService;

        require_once(__DIR__ . "/../views/shop/getdata.php");
    }
}
