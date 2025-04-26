<?php 

$error = [];
$user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';

    switch($_POST['action']) {
        case 'login':
            userConnect();
            break;

        case 'register':
            $user = dataValidation();
            $user ? registerToDB($user) : var_dump($error);
            break;
            // might need to modify the algo: get the data, validate returning bool, if validate -> save to DB, else render('connection', false, ['error' = $error]);

        default:
            echo "Action inconnue";
            break;
    }
} else {
    // calls the connection view
    render('connection');
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     require 'models/users.php';

//     switch($_POST['action']) {
//         case 'login':
//             userConnect();
//             break;

//         case 'register':
//             $user = dataValidation();
//             $user ? registerToDB($user) : render('connection', false, ['error' => $error]);
//             break;

//         default:
//             echo "Action inconnue";
//             break;
//     }
// } else {
//     // calls the connection view
//     render('connection');
// }
?>