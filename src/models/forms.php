<?php 

// case 'login' algo
function getLoginData() {
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    return [
        'email' => $email, 
        'password' => $password
    ];
}

function userConnect() {
    // collect passed data
    $login = getLoginData();

    // check credentials validity from DB
    $user = getUserByEmail($login['email']);

    if ($user && password_verify($login['password'], $user['password'])) {
        // $_SESSION['user_id'] = $user['id_users'];
        $_SESSION['user'] = getUserById($user['id_users']);
    } else {
        $error['login'] = "Email ou mot de passe incorrect";
    }

    // if valid credentials, proceed to user account
    if (empty($error)) {
        header('Location: /user-account');
        exit();
    } else {
        render('connection', false, [
            'error' => $error,
            'user' => $user,
        ]);
    }
}


// case 'register' algo
function getRegisterData() {
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $pwdConfirm = isset($_POST['pwdConfirm']) ? $_POST['pwdConfirm'] : '';
    $addressMain = isset($_POST['address']) ? $_POST['address'] : '';
    $addressComplement = isset($_POST['addressComplement']) ? $_POST['addressComplement'] : '';
    $zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $communication = isset($_POST['communication']) ? $_POST['communication'] : '';
    $newsletter = isset($_POST['newsletter']) ? $_POST['newsletter'] : '';

    return [
        'firstname' => $firstName, 
        'lastname' => $lastName, 
        'email' => $email, 
        'password' => $password, 
        'pwdConfirm' => $pwdConfirm, 
        'addressMain' => $addressMain, 
        'addressComplement' => $addressComplement, 
        'zipcode' => $zipcode, 
        'city' => $city, 
        'phone' => $phone, 
        'communication' => $communication, 
        'newsletter' => $newsletter];
}

function dataValidation() {

    $dataReg = getRegisterData();

    // input validation for firstname and lastname
    $namePattern = "/^[A-Za-zÀ-ÿ' ]+$/";
    if (!empty($dataReg['firstname']) && !empty($dataReg['lastname'])) {
        if (strlen($dataReg['firstname']) <= 50 && strlen($dataReg['lastname']) <= 50) {
            if(preg_match($namePattern, $dataReg['firstname']) && preg_match("/^[a-zA-Z-' ]*$/", $dataReg['lastname'])) {
                $user['firstname'] = htmlspecialchars($dataReg['firstname']);
                $user['lastname'] = htmlspecialchars($dataReg['lastname']);
            } else {
                $error['name'] = 'le prénom et le nom ne peuvent contenir que les lettres, espaces et tirets';
            }
        } else {
            $error['name'] = 'le prénom et le nom ne doivent pas dépasser 50 caractères';
        }
    } else {
        $error['name'] = 'Le prénom et le nom sont requis';
    }
    
    // input validation for email
    if (!empty($dataReg['email'])) {
        if (filter_var($dataReg['email'], FILTER_VALIDATE_EMAIL)) {
            if (!userExists($dataReg['email'])) {
                $user['email'] = htmlspecialchars($dataReg['email']);
            } else {
                $error['email'] = "Un compte avec cette adresse email existe déjà";
            }
        } else {
            $error['email'] = "L'adresse email n'est pas valide";
        }
    } else {
        $error['email'] = "L'email est requis";
    }

    // input validation for password
    $pwdPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";
    if (!empty($dataReg['password']) && !empty($dataReg['pwdConfirm'])) {
        if (preg_match($pwdPattern, $dataReg['password'])) {
            if ($dataReg['password'] === $dataReg['pwdConfirm']) {
                $user['password'] = password_hash($dataReg['password'], PASSWORD_DEFAULT);
            } else {
                $error['password'] = "Le mot de passe et sa confirmation ne correspondent pas";
            }
        } else {
            $error['password'] = "Le mot de passe doit contenir entre 8 et 15 caractères dont au moins une minuscule, une majuscule, un chiffre et un caractère spécial parmi @,$,!,%,*,?,&";
        }
    } else {
        $error['password'] = "Le mot de passe et sa confirmation sont requis";
    }

    // input validation for address and complement
    $addressPattern = "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9-,' ]+$/";
    $address = [
        'main' => $dataReg['addressMain'],
        'complement' => $dataReg['addressComplement']
    ];
    foreach($address as $key => $value){
        if (!empty($value)) {
            if (strlen($value) <= 50) {
                if(preg_match($addressPattern, $value)) {
                    $user['address'][$key] = htmlspecialchars($value);
                } else {
                    $error['address'][$key] = "L'adresse ou son complément comportent des caractères non autorisés";
                }
            } else {
                $error['address'][$key] = "L'adresse ou son complément ne doivent pas dépasser 50 caractères";
            }
        } else {
            $user['address'][$key] = NULL;
        }
    }

    //input validation for zipcode
    $zipcodePattern = "/^[0-9]{5}$/";
    if (!empty($dataReg['zipcode'])) {
        if (preg_match($zipcodePattern, $dataReg['zipcode'])) {
            $user['zipcode'] = htmlspecialchars($dataReg['zipcode']);
        } else {
            $error['zipcode'] = "Le code postal doit être strictement composé de 5 chiffres";
        }
    } else {
        $user['zipcode'] = NULL;
    }

    //input validation for city
    $cityPattern = "/^[A-Za-zÀ-ÿ' ]+$/";
    if (!empty($dataReg['city'])) {
        if (strlen($dataReg['city']) <= 50) {
            if (preg_match($cityPattern, $dataReg['city'])) {
                $user['city'] = htmlspecialchars($dataReg['city']);
            } else {
                $error['city'] = "Le format du nom de ville est invalide";
            }
        } else {
            $error['city'] = "Le nom de ville est limité à 50 charactères";
        }

    } else {
        $user['city'] = NULL;
    }

    //input validation for phone
    $phonePattern = "/^0([67]\d{8}|([1-5]|9)\d{8})$/";
    if (!empty($dataReg['phone'])) {
        if (preg_match($phonePattern, $dataReg['phone'])) {
            $user['phone'] = htmlspecialchars($dataReg['phone']);
        } else {
            $error['phone'] = "Le format du numéro de téléphone est invalide (numéro national à 10 chiffres hors numéro en 08";
        }
    } else {
        $user['phone'] = '';
    }
    
    //input validation for communication (input type = select)
    $isMobilePhone = (substr($dataReg['phone'], 0, 2) == '06' || substr($dataReg['phone'], 0, 2) == '07');
    switch ($dataReg['communication']) {
        case 'email':
            $user['communication'] = htmlspecialchars($dataReg['communication']);
            break;
        case 'sms':
            if ($isMobilePhone) {
                $user['communication'] = htmlspecialchars($dataReg['communication']);
                break;
            } else {
                $error['communication'] = "Le numéro de téléphone indiqué ne permet pas l'envoi de SMS. Veuillez choisir une autre option de communication ou revenir à l'étape précédente pour renseigner un numéro de téléphone compatible";
            }
        case 'both':
            if ($isMobilePhone) {
                $user['communication'] = htmlspecialchars($dataReg['communication']);
                break;
            } else {
                $error['communication'] = "Le numéro de téléphone indiqué ne permet pas l'envoi de SMS. Veuillez choisir une autre option de communication ou revenir à l'étape précédente pour renseigner un numéro de téléphone compatible";
            }
        case 'none':
            $user['communication'] = htmlspecialchars($dataReg['communication']);
            break;
        default:
            $error['communication'] = "Valeur non valide";
    }

    //input validation for newsletter (input type = select)
    switch ($dataReg['newsletter']) {
        case 'true':
            $user['newsletter'] = htmlspecialchars($dataReg['newsletter']);
            break;
        case 'false':
            $user['newsletter'] = htmlspecialchars($dataReg['newsletter']);
            break;
        default:
            $error['newsletter'] = "valeur non valide";
    }

    if (empty($error)) {
        return $user;
    } else {
        return $error;
    }
    
    // return empty($error) ? true : false;
    
}

function registerToDB($user) {
    createUser($user);

    // check for input of address details
    if (isset($user['address']['main']) || isset($user['address']['complement']) || isset($user['zipcode']) || isset($user['city'])) {
        $userId = getUserByEmail($user['email'])['id_users'];
        $user["id"] = $userId;
        createAddress($user);
    }

    echo "informations transmises avec succès, vous pouvez maintenant vous connecter";
    render('connection'); 
    
}


// case 'logout' algo
function userLogout() {
    // unset session variables
    $_SESSION = [];

    // kill the session
    session_destroy();

    // redirection to login
    header('Location: /connection');
    exit();
}

// case 'delete account' algo
// function deleteAccount() {
//     if (isset($_SESSION['user'])) {

// }

?>