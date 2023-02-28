<?php
// Service
require_once(__DIR__ . '/../services/ProductService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class HomeController
{
    private ProductService $productService;
    private NavbarFunctions $navFunc;
    private string $page;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->navFunc = new NavbarFunctions();
        $this->page = 'home';
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
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . '/../views/home/index.php');
    }
}
