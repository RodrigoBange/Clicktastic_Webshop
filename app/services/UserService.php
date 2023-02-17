<?php
// Repository
require(__DIR__. ' /../repositories/UserRepository.php');

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Attempts to log in the user and returns a bool.
     */
    public function loginUser($email, $password) : bool
    {
        // Get user information
        $user = $this->userRepository->getUser($email);

        if ($user != null) { // Attempt to log user in
            if (password_verify($password, $user->password)) {
                // Save values to session
                $_SESSION['logged_in'] = true;
                $_SESSION['name'] = $user->first_name;
                $_SESSION['email'] = $user->email;
                $_SESSION['is_admin'] = $user->is_admin;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Attempts to register a new user.
    public function registerUser($email, $firstname, $lastname, $password) : bool
    {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$this->isPrevCustomer($email)) { // If it's not a previous customer
            // Attempt to register user and return status
            return $this->userRepository->registerUser(
                $email,
                $firstname,
                $lastname,
                $hashedPassword
            );
        } else { // Update information of customer to have a password
            return $this->userRepository->addPassword($password, $email);
        }
    }

    /**
     * Checks if email belongs to unregistered customer
     */
    public function isPrevCustomer($email) : bool
    {
        return $this->userRepository->emailExists($email);
    }

    /**
     * Checks if the user already exists.
     */
    public function userExists($email) : bool
    {
        // return true or false
        return $this->userRepository->userExists($email);
    }

    /**
     * Register a customer's info (Not a user)
     */
    public function registerCustomer($userInfo) : bool
    {
        return $this->userRepository->registerCustomer($userInfo);
    }

    public function getAll() : array|null
    {
        $users = $this->userRepository->getAll();

        if ($users != null) {
            return $users;
        }
        return null;
    }

    public function getUserId($email)
    {
        return $this->userRepository->getUserId($email);
    }

    public function getUser($email)
    {
        return $this->userRepository->getUser($email);
    }

    public function updateUser($userInfo) : bool
    {
        return $this->userRepository->updateUser($userInfo);
    }
}
