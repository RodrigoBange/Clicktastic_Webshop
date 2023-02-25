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
    public function loginUser(): bool
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // Get user information
            $user = $this->userRepository->getUser($_POST['email']);

            if ($user != null) { // Attempt to log user in
                if (password_verify($_POST['password'], $user->password)) {
                    // Save user to session
                    $_SESSION['user'] = serialize($user);
                    // Set quick access values
                    $_SESSION['display_name'] = $user->first_name;
                    $_SESSION['is_admin'] = $user->is_admin;

                    // Save values to session
                    //$_SESSION['logged_in'] = true;
                    //$_SESSION['name'] = $user->first_name;
                    //$_SESSION['email'] = $user->email;
                    //$_SESSION['is_admin'] = $user->is_admin;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Attempts to sign up a new user
     */
    public function signupUser(): array
    {
        // Variables to return
        $registerSuccess = 0;
        $emailExists = 0;

        if (isset($_POST['email']) && isset($_POST['firstname'])
            && isset($_POST['lastname']) && isset($_POST['password'])) {
            // Check if user email does not exist already
            if (!$this->userExists($_POST['email'])) {
                // Register user
                $registerSuccess = (int)$this->registerUser($_POST['email'], $_POST['firstname'],
                                                            $_POST['lastname'], $_POST['password']);
            } else {
                // Email already exists
                $emailExists = 1;
            }
        }

        // Return results
        return array(
            "registerSuccess" => $registerSuccess,
            "emailExists" => $emailExists
        );
    }

    /**
     * Registers a new user to the database
     */
    public function registerUser($email, $firstname, $lastname, $password): bool
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
     * Logs out the user and unsets the session
     */
    public function logoutUser(): void
    {
        session_unset();
        header('Location: /login/login');
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
