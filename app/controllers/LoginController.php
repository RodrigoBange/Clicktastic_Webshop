<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');

// Models
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class LoginController
{
    private UserService $userService;
    private NavbarFunctions $navFunc;

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
        require_once(__DIR__ . '/../views/login/login.php');
    }

    public function loginuser(): void
    {
        // Attempt to log in user and return bool
        $result = $this->userService->loginUser();

        // Return result
        echo json_encode($result);
    }

    public function signup(): void
    {
        // Navigation functions
        $navFunc = $this->navFunc;

        // Load the view
        require_once(__DIR__ . '/../views/login/signup.php');
    }

    public function signupuser(): void
    {
        // Sign up user
        $result = $this->userService->signupUser();

        // Return result
        echo json_encode($result);
    }

    public function logout(): void
    {
        $this->userService->logoutUser();
    }
}
