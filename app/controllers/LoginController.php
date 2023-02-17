<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');

// Models
require_once(__DIR__ . "/../models/NavbarFunctions.php");

class LoginController
{
    private $userService;
    private $navFunc;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->navFunc = new NavbarFunctions();
    }

    public function login(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/login/login.php");
    }

    public function signup(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . "/../views/login/signup.php");
    }

    public function registeruser(): void
    {
        $userService = $this->userService;

        // Load the view
        require_once(__DIR__ . "/../views/login/registeruser.php");
    }

    public function loginuser(): void
    {
        $userService = $this->userService;

        // Load the view
        require_once(__DIR__ . "/../views/login/loginuser.php");
    }
}
