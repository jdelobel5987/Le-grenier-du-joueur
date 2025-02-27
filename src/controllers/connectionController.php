<?php 

$error = [];
$user = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';
    switch($_POST['action']) {
        case 'login':
            //collect passed data
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            // check valid credentials in DB
            $user = getUserByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                // retrieve user id and store in session
                $_SESSION['user_id'] = $user['id_users'];
                echo "connexion réussie!";
                var_dump($_SESSION['user']);
                // redirect to home page (ou page account?)
                // header('Location: /index');
            } else {
                $error['login'] = "Email ou mot de passe incorrect";
            }
            if (empty($error)) {
                render('user-account');
            }
            break;

        case 'register':
            // declaration of variables
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

            $user = [];

            // input validation for firstname and lastname
            $namePattern = "/^[A-Za-zÀ-ÿ' ]+$/";
            if (!empty($firstName) && !empty($lastName)) {
                if (strlen($firstName) <= 50 && strlen($lastName) <= 50) {
                    if(preg_match($namePattern, $firstName) && preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
                        $user['firstname'] = htmlspecialchars($firstName);
                        $user['lastname'] = htmlspecialchars($lastName);
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
            if (!empty($email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (!userExists($email)) {
                        $user['email'] = htmlspecialchars($email);
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
            if (!empty($password) && !empty($pwdConfirm)) {
                if (preg_match($pwdPattern, $password)) {
                    if ($password === $pwdConfirm) {
                        $user['password'] = password_hash($password, PASSWORD_DEFAULT);
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
                'main' => $addressMain,
                'complement' => $addressComplement
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
            if (!empty($zipcode)) {
                if (preg_match($zipcodePattern, $zipcode)) {
                    $user['zipcode'] = htmlspecialchars($zipcode);
                } else {
                    $error['zipcode'] = "Le code postal doit être strictement composé de 5 chiffres";
                }
            } else {
                $user['zipcode'] = NULL;
            }

            //input validation for city
            $cityPattern = "/^[A-Za-zÀ-ÿ' ]+$/";
            if (!empty($city)) {
                if (strlen($city) <= 50) {
                    if (preg_match($cityPattern, $city)) {
                        $user['city'] = htmlspecialchars($city);
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
            if (!empty($phone)) {
                if (preg_match($phonePattern, $phone)) {
                    $user['phone'] = htmlspecialchars($phone);
                } else {
                    $error['phone'] = "Le format du numéro de téléphone est invalide (numéro national à 10 chiffres hors numéro en 08";
                }
            } else {
                $user['phone'] = '';
            }
            
            //input validation for communication (input type = select)
            $isMobilePhone = (substr($phone, 0, 2) == '06' || substr($phone, 0, 2) == '07');
            switch ($communication) {
                case 'email':
                    $user['communication'] = htmlspecialchars($communication);
                    break;
                case 'sms':
                    if ($isMobilePhone) {
                        $user['communication'] = htmlspecialchars($communication);
                        break;
                    } else {
                        $error['communication'] = "Le numéro de téléphone indiqué ne permet pas l'envoi de SMS. Veuillez choisir une autre option de communication ou revenir à l'étape précédente pour renseigner un numéro de téléphone compatible";
                    }
                case 'both':
                    if ($isMobilePhone) {
                        $user['communication'] = htmlspecialchars($communication);
                        break;
                    } else {
                        $error['communication'] = "Le numéro de téléphoneindiqué ne permet pas l'envoi de SMS. Veuillezchoisir une autre option de communication ourevenir à l'étape précédente pour renseigner unnuméro de téléphone compatible";
                    }
                case 'none':
                    $user['communication'] = htmlspecialchars($communication);
                    break;
                default:
                    $error['communication'] = "Valeur non valide";
            }

            //input validation for newsletter (input type = select)
            switch ($newsletter) {
                case 'true':
                    $user['newsletter'] = htmlspecialchars($newsletter);
                    break;
                case 'false':
                    $user['newsletter'] = htmlspecialchars($newsletter);
                    break;
                default:
                    $error['newsletter'] = "valeur non valide";
            }

            //transmission to DB
            if (empty($error)) {
                // create user & get the newly created id
                // $userId = createUser($user);
                createUser($user);
    
                // check for input of address details
                if (isset($user['address']['main']) || isset($user['address']['complement']) || isset($user['zipcode']) || isset($user['city'])) {
                    $userId = getUserByEmail($user['email'])['id_users'];
                    $user["id"] = $userId;
                    createAddress($user, $userId);
                }

                // confirmation 
                $error['none'] = "informations transmises avec succès, vous pouvez maintenant vous connecter";
            } else {
                var_dump($error); // to remove //
            }

            break;
        default:
            echo "Action inconnue";
            break;
    }
}

// calls the connection view
render('connection', false, [
    'error' => $error,
    'user' => $user,
]);

?>