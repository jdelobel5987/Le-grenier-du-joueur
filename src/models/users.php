<?php

// // Récupérer tous les utilisateurs (id et nom uniquement)
// function getAllUsers() {
//     $pdo = getConnexion();
//     $sql = "SELECT id, nom FROM users";
//     try {
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch(PDOException $e) {
//         echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
//         return false;
//     }
// }

// // Récupérer un utilisateur par son ID

function getUserById($id) {
    $pdo = getConnexion();
    $sql = "SELECT * FROM `ijen_users` 
            INNER JOIN `ijen_addresses`
            ON `ijen_users`.`id_users` = `ijen_addresses`.`id_users`
            WHERE `ijen_users`.`id_users` = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

// Récupérer un utilisateur par son email
function getUserByEmail($email) {
    $pdo = getConnexion();
    $sql = "SELECT `id_users`, `email`, `password` FROM `ijen_users` WHERE `email` = :email";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

// Créer un nouvel utilisateur ($user est une table assoc des champs de formulaire validés)
function createUser($user, $role = 2) {
    $pdo = getConnexion();
    $sql = "INSERT INTO `ijen_users` (`firstname`, `lastname`, `email`, `password`, `phone`, `communication`, `newsletter`, `id_roles`) 
            VALUES (:firstname, :lastname, :email, :password, :phone, :communication, :newsletter, :id_roles)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $user['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $user['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $user['password'], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user['phone'], PDO::PARAM_STR);
        $stmt->bindParam(':communication', $user['communication'], PDO::PARAM_STR);
        $stmt->bindParam(':newsletter', $user['newsletter'], PDO::PARAM_STR);
        $stmt->bindParam(':id_roles', $role, PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

// Enregistrer une adresse utilisateur 
// (context création de compte, $user est un tableau de tous les champs de formulaire, $id est le users_id retourné en fin de createUser() )
// (context création adresse a posteriori, il faudra récupérer l'id de l'utilisateur à son login )
function createAddress($user) {
    $pdo = getConnexion();
    $sql = "INSERT INTO `ijen_addresses` (address, complement, zipcode, city, id_users) 
            VALUES (:address, :complement, :zipcode, :city, :id_users)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':address', $user['address']['main'], PDO::PARAM_STR);
        $stmt->bindParam(':complement', $user['address']['complement'], PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $user['zipcode'], PDO::PARAM_STR);
        $stmt->bindParam(':city', $user['city'], PDO::PARAM_STR);
        $stmt->bindParam(':id_users', $user['id'], PDO::PARAM_INT);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la création de l'adresse utilisateur : " . $e->getMessage();
        return false;
    }
}

//vérifier l'existance d'un compte avec un email donné (returns true si un compte avec email donné existe déjà)
function userExists($email) {
    $pdo = getConnexion();
    $sql = "SELECT COUNT(*) FROM `ijen_users` WHERE email = :email";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    } catch(PDOException $e) {
        echo "Erreur lors de la vérification";
    }
}

// // Créer un nouvel utilisateur
// function createUser($nom, $email, $password) {
//     $pdo = getConnexion();
//     $sql = "INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)";
//     try {
//         $stmt = $pdo->prepare($sql);
//         $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
//         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//         $stmt->bindParam(':password', $password, PDO::PARAM_STR);
//         return $stmt->execute();
//     } catch(PDOException $e) {
//         echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
//         return false;
//     }
// }

// Mettre à jour un utilisateur
// function updateUser($id, $nom, $email, $password) {
//     $pdo = getConnexion();
//     $sql = "UPDATE users SET nom = :nom, email = :email, password = :password WHERE id = :id";
//     try {
//         $stmt = $pdo->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
//         $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//         $stmt->bindParam(':password', $password, PDO::PARAM_STR);
//         return $stmt->execute();
//     } catch(PDOException $e) {
//         echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
//         return false;
//     }
// }

// Mettre à jour un utilisateur
function updateSingleField($id, $table, $field, $value) {
    $pdo = getConnexion();

    $allowedTables = ['ijen_users', 'ijen_addresses'];
    $allowedFields = [
        'ijen_users' => ['firstname', 'lastname', 'email', 'password', 'phone', 'communication', 'newsletter'],
        'ijen_addresses' => ['address', 'complement', 'zipcode', 'city']
        ];
    if(!in_array($table, $allowedTables) || !in_array($field, $allowedFields[$table])) {
        throw new Exception("Table ou champ invalide");
    }
    
    $sql = "UPDATE $table SET $field = :value WHERE id_users = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

function updateUserDetails($id, $fields) {
    $pdo = getConnexion();
    $sql = "UPDATE `ijen_users` 
            SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = :password, `phone` = :phone, `communication` = :communication, `newsletter` = :newsletter 
            WHERE `id_users` = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':firstname', $fields['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $fields['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $fields['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $fields['password'], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $fields['phone'], PDO::PARAM_STR);
        $stmt->bindParam(':communication', $fields['communication'], PDO::PARAM_STR);
        $stmt->bindParam(':newsletter', $fields['newsletter'], PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

function updateUserAddress($id, $fields) {
    $pdo = getConnexion();
    $sql = "UPDATE `ijen_addresses` 
            SET `address` = :address, `complement` = :complement, `zipcode` = :zipcode, `city` = :city 
            WHERE `id_users` = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':address', $fields['address'], PDO::PARAM_STR);
        $stmt->bindParam(':complement', $fields['complement'], PDO::PARAM_STR);
        $stmt->bindParam(':zipcode', $fields['zipcode'], PDO::PARAM_STR);
        $stmt->bindParam(':city', $fields['city'], PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

// // Supprimer un utilisateur
function deleteUser($id) {
    $pdo = getConnexion();
    $sql = "DELETE FROM `ijen_users` WHERE `id_users` = :id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
        return false;
    }
}

?>