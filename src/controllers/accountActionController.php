<?php

// manage the account actions from user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';
    require 'models/forms.php';

    switch ($_POST['action']) {
        case 'logout':
            userLogout();
            break;

        case 'deleteAccount':
            deleteAccount();
            break;

        default:
            echo "post menu déroulant mon compte";
            echo "Action inconnue";
            break;
    }
} else {
    // calls the user-account view
    render('user-account');
    
}

?>