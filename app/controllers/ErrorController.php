<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class ErrorController
{
    private NavbarFunctions $navFunc;

    public function __construct()
    {
        $this->navFunc = new NavbarFunctions();
    }

    public function error(): void
    {
        // Navbar functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/error/404.php');
    }
}