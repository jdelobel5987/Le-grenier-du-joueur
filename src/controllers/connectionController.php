<?php 

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';
    switch($_POST['action']) {
        case 'login':
            //collect passed data
            $email = $_POST['email'];
            $password = $_POST['password'];
            // check valid credentials in DB
            $user = getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                // retrieve user data
                $_SESSION['user'] = $user;
                // redirect to home page
                header('Location: /index');
            } else {
                echo "Email ou mot de passe incorrect";
            }
            break;

        case 'register':
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $address = $_POST['address'];
            $addressComplement = $_POST['addressComplement'];
            $zipcode = $_POST['zipcode'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $communication = $_POST['communication'];
            $newsletter = $_POST['newsletter'];

            $user = [
                'firstname' => $_POST['firstName'],
                'lastname' => $_POST['lastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'address' => $_POST['address'],
                'addressComplement' => $_POST['addressComplement'],
                'zipcode' => $_POST['zipcode'],
                'city' => $_POST['city'],
                'phone' => $_POST['phone'],
                'communication' => $_POST['communication'],
                'newsletter' => $_POST['newsletter'],
            ];

            // var_dump($user);

            createUser($user);
            
            $_SESSION['user'] = $user;

            // check valid inputs
            // createUser($nom, $email, $password....);
            // attention! 2 tables in DB: users and addresses
            break;
        default:
            echo "Action inconnue";
            break;
    }
} else {
    // calls the connection view
    render('connection');
}

?>