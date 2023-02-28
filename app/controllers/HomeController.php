<?php
// Service
require_once(__DIR__ . '/../services/ProductService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class HomeController
{
    private ProductService $productService;
    private NavbarFunctions $navFunc;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->navFunc = new NavbarFunctions();
    }

    /**
     * Opens the home page
     */
    public function index(): void
    {
        // Get the newest products to display
        $newestProducts = $this->productService->getNewestProducts();

        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/home/index.php');
    }
}
