<?php

// manage the user account update actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';

    foreach($_POST as $key => $value) {
        $POST[$key] = htmlspecialchars($value);
    }
    $field = $_POST['field'];
    $id = $_SESSION['user']['id_users'];
    
    if ($field === "all") {
        switch ($_POST['action']) {
            case 'userEdit':
                // edit all fields in users table
                $updateAll = updateUserDetails($id, $_POST);
                // if ($updateAll) {
                //     render('user-account', false, [
                //         'updateMsg' => "informations de compte mises à jour avec succès"
                //     ]);
                // }
                break;

            case 'addressEdit':
                // edit all fields in addresses table
                $updateAll = updateUserAddress($id, $_POST);
                // if ($updateAll) {
                //     render('user-account', false, [
                //         'updateMsg' => "informations d'adresse mises à jour avec succès"
                //     ]);
                // }
                break;
            
            default:
                render('editAccount', false, [
                    'error' => "action inconnue"
                ]);
                // echo "action inconnue";
        }  
    } else {
        // update single field
        $userTable = ['firstname', 'lastname', 'email', 'password', 'phone', 'communication', 'newsletter'];
        $addressTable = ['address', 'complement', 'zipcode', 'city'];
        $table = in_array($field, $userTable) ? 'ijen_users' : (in_array($field, $addressTable) ? 'ijen_addresses' : 'false');
        
        if (in_array($field, $userTable)) {
            $table = 'ijen_users';
        } elseif (in_array($field, $addressTable)) {
            $table = 'ijen_addresses';
        } else {
            echo "champs inconnu";
            exit();
        }

        $value = htmlspecialchars($_POST[$field]);

        $updateField = updateSingleField($id, $table, $field, $value);
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