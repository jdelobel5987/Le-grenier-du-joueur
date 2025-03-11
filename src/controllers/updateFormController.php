<?php

// manage the user account update actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';

    $id = $_SESSION['user']['id_users'];

    // validate fields
    $user = validateFields($_POST);
    // var_dump($_POST);
    // var_dump($user);

    // identify the action (update all fields vs one field) and the submitted form
    $field = $_POST['field'];
    
    if ($field === "all") {
        switch ($_POST['action']) {
            case 'userEdit':
                // edit all fields in users table
                $updateAll = updateUserDetails($id, $user);
                break;

            case 'addressEdit':
                // edit all fields in addresses table
                $updateAll = updateUserAddress($id, $user);
                break;
            
            default:
                render('editAccount', false, [
                    'error' => "action inconnue"
                ]);
        }
    } else {
        // update single field
        $userTable = ['firstname', 'lastname', 'email', 'password', 'phone', 'communication', 'newsletter'];
        $addressTable = ['address', 'complement', 'zipcode', 'city'];
        
        // define the table concerned by the update
        if (in_array($field, $userTable)) {
            $table = 'ijen_users';
        } elseif (in_array($field, $addressTable)) {
            $table = 'ijen_addresses';
        } else {
            echo "champs inconnu";
            exit();
        }

        // $value = htmlspecialchars($_POST[$field]);
        // var_dump($_POST);
        // var_dump($user);

        // define the validated value for the update
        $value = $user[$field] ?? null;

        if($value !== null) {
            $updateField = updateSingleField($id, $table, $field, $value);
        } else {
            echo "Champs invalide";
        }
        // if ($updateField) {
        //     header("Location: user-account");
        //     exit();
        // }
    }

    // update the $_SESSION['user'] for immediate proper display of new account data
    $updatedUserData = getUserById($id);
    if ($updatedUserData) {
        $_SESSION['user'] = $updatedUserData;
        header("Location: user-account");
        exit();
    } else {
        echo "Erreur lors de la mise à jour des données de session.";
    }

} else {
    render('editAccount');
}

?>