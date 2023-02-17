<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');
require_once(__DIR__ . '/../services/ProductService.php');

// Models
require_once(__DIR__ . "/../models/NavbarFunctions.php");

class HomeController
{
    private $productService;
    private $userService;
    private $navFunc;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->userService = new UserService();
        $this->navFunc = new NavbarFunctions();
    }

    public function index()
    {
        $products = $this->productService->getNewestProducts();

        // Navigation functions
        $navFunc = $this->navFunc;

        require_once(__DIR__ . "/../views/home/index.php");
    }
}
