<?php
// Service
require_once(__DIR__ . '/../services/UserService.php');

// Model
require_once(__DIR__ . '/../models/NavbarFunctions.php');

class LoginController
{
    private UserService $userService;
    private NavbarFunctions $navFunc;
    private string $page;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->navFunc = new NavbarFunctions();
        $this->page = 'login';
    }

    /**
     * Opens the login page
     */
    public function login(): void
    {
        if (isset($_SESSION['user'])) {
            header("location: /account/account");
            return;
        }

        // Navigation functions
        $navFunc = $this->navFunc;
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . '/../views/login/login.php');
    }

    /**
     * AJAX, logs in the user
     */
    public function loginuser(): void
    {
        // Attempt to log in user and return bool
        $result = $this->userService->loginUser();

        // Return result
        echo json_encode($result);
    }

    /**
     * Opens the sign up page
     */
    public function signup(): void
    {
        if (isset($_SESSION['user'])) {
            header("location: /account/account");
            return;
        }

        // Navigation functions
        $navFunc = $this->navFunc;
        $page = $this->page;

        // Load the view
        require_once(__DIR__ . '/../views/login/signup.php');
    }

    /**
     * AJAX, signs up the new user
     */
    public function signupuser(): void
    {
        // Sign up user
        $result = $this->userService->signupUser();

        // Return result
        echo json_encode($result);
    }

    /**
     * AJAX, logs out the user
     */
    public function logout(): void
    {
        // Log out the user
        $this->userService->logoutUser();
    }
}
