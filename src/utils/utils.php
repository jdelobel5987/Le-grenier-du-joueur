<?php

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////// DISPLAY VIEWS-TEMPLATES /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

// function to display a view (by default) or a template when specified as 2nd argument
// with possibility to pass data (empty array by default)
function render($path, $template = false, $data = []) {
	// Convertir les clés de $data en variables accessibles dans la vue
    extract($data);
	if ($template) {
		require "templates/$path.php";
	} else {
		require "views/$path.php";
	}
}


/////////////////////////////////////////////////////////////////////////////////
/////////////////////////// REGISTRATION - LOGIN ////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

// function containing the validation algorithm for the registration form
function dataValidation() {
    $dataReg = $_POST;

    // input validation for firstname and lastname
    $namePattern = "/^[A-Za-zÀ-ÿ' ]+$/";
    if (!empty($dataReg['firstName']) && !empty($dataReg['lastName'])) {
        if (strlen($dataReg['firstName']) <= 50 && strlen($dataReg['lastName']) <= 50) {
            if(preg_match($namePattern, $dataReg['firstName']) && preg_match("/^[a-zA-Z-' ]*$/", $dataReg['lastName'])) {
                $user['firstname'] = htmlspecialchars($dataReg['firstName']);
                $user['lastname'] = htmlspecialchars($dataReg['lastName']);
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
        // 'main' => $dataReg['addressMain'],
        'main' => $dataReg['address'],
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
        return $error; // should return false instead ? then in connectionController $user ? registerToDB($user) : render('connection', false, ['error' => $error]); 
    }
    
    // return empty($error) ? true : false;
    
}

// function that register user data to the DB (createUser() & createAddress())
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


// function containing the connection algorithm (DB interactions getUserByEmail() & getUserById())
function userConnect() {
	// collect passed data
    $login = [
		'email' => $_POST['email'], 
		'password' => $_POST['password']
	];
	
    // check credentials validity from DB
    $user = getUserByEmail(htmlspecialchars($login['email']));
	
    if ($user && password_verify($login['password'], $user['password'])) {
		session_start();
        $_SESSION['user'] = getUserById($user['id_users']);
    } else {
		$error['login'] = "Email ou mot de passe incorrect";
    }
	
    // if valid credentials, proceed to user account
    if (empty($error)) {
        render('user-account');
		// header('Location: /user-account');
        // exit();
    } else {
		render('connection', false, [
			'error' => $error,
            'user' => $user,
        ]);
    }
}

// function to check if the user is logged in
function isLogged() {
	// return isset($_SESSION['user_id']) ? true : false;
	return isset($_SESSION['user']) ? true : false;
}


/////////////////////////////////////////////////////////////////////////////////
///////////////////////////// ACCOUNT ACTIONS ///////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

// function containing the logout algorithm (no DB interaction)
function userLogout() {
    // unset variables, kill the session and redirect to login
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header('Location: /connection');
    exit();
}

// function containing the delete user algorithm (DB interaction deleteUser())
function deleteAccount() {
    if (!isset($_SESSION['user'])) {
        header('Location: /connection');
        exit();
    }
    
    $userId = $_SESSION['user']['id_users'];
    
    if (!empty($userId) && deleteUser($userId)) {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /');
        echo "Votre compte a bien été supprimé";
        exit();
    } else {
        userLogout();
        echo "Un problème est survenu lors de la suppression de votre compte, veuillez vous reconnecter.";
    }
}


/////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// AUTO LOGOUT ////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

// function for auto-logout after inactivity (default 300 seconds) (called in router before routing)
function checkUserSession($inactivityLimit = 300) {
    $currentTime = time();

    if(isset($_SESSION['user'])) {
        // check the time lapsed since last activity of the logged-in user, if above the limit: trigger logout
        if(isset($_SESSION['last_activity']) && ($currentTime - $_SESSION['last_activity']) > $inactivityLimit) {
            userLogout();
        }

        // session variable created at first routing for a logged-in user 
        $_SESSION['last_activity'] = $currentTime;
    }
}