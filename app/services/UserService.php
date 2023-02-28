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
                if (password_verify($_POST['password'], $user->getPassword())) {
                    // Save user to session
                    $_SESSION['user'] = serialize($user);
                    // Set quick access values
                    $_SESSION['display_name'] = $user->getFirstName();
                    $_SESSION['is_admin'] = $user->getIsAdmin();
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
    public function registerUser(string $email, string $firstname, string $lastname, string $password): bool
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
    public function isPrevCustomer(string $email): bool
    {
        return $this->userRepository->emailExists($email);
    }

    /**
     * Checks if the user already exists.
     */
    public function userExists(string $email): bool
    {
        // return true or false
        return $this->userRepository->userExists($email);
    }

    /**
     * Register a customer's info (Not a user)
     */
    public function registerCustomer(array $userInfo): bool
    {
        return $this->userRepository->registerCustomer($userInfo);
    }

    /**
     * Retrieves all users
     */
    public function getAll(): array|null
    {
        $users = $this->userRepository->getAll();

        if ($users != null) {
            return $users;
        }
        return null;
    }

    /**
     * Gets a specific user's ID by email
     */
    public function getUserId(string $email)
    {
        return $this->userRepository->getUserId($email);
    }

    /**
     * Gets a specific user by email
     */
    public function getUser(string $email)
    {
        return $this->userRepository->getUser($email);
    }

    /**
     * Updates a user's information
     */
    public function updateUser(User $user): bool
    {
        $result = false;

        // Check if form was submitted
        if (isset($_POST)) {
            $userInfo = array(
                'first_name' => $_POST['firstName'],
                'last_name' => $_POST['lastName'],
                'address' => $_POST['address'],
                'address_optional' => $_POST['address2'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'postal_code' => $_POST['zip'],
                'country' => $_POST['country'],
                'phone_number' => $_POST['phoneNumber'],
                'email' => $user->getEmail()
            );

            // Attempt to update
            $result = $this->userRepository->updateUser($userInfo);

            // If successful, update information
            if ($result) {
                // Update user with new database values
                $_SESSION['user'] = serialize($this->getUser($user->getEmail()));
                $_SESSION['display_name'] = $user->getFirstName();
                $_SESSION['is_admin'] = $user->getIsAdmin();
            }
        }
        return $result;
    }

    /**
     * Unserializes the user session value to a user object
     */
    public function unserializeUser(): User|null
    {
        if (!isset($_SESSION['user'])) {
            return null;
        } else {
            // Deserialize to object
            return unserialize($_SESSION['user']);
        }
    }
}
