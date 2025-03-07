<?php

// manage the account actions from user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';

    switch ($_POST['action']) {
        case 'edit':
            render('editAccount');
            break;
        
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