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
// function getUserById($id) {
//     $pdo = getConnexion();
//     $sql = "SELECT * FROM users WHERE id = :id";
//     try {
//         $stmt = $pdo->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     } catch(PDOException $e) {
//         echo "Erreur lors de la récupération de l'utilisateur : " . $e->getMessage();
//         return false;
//     }
// }

// Récupérer un utilisateur par son email
function getUserByEmail($email) {
    $pdo = getConnexion();
    $sql = "SELECT `email`, `password` FROM `ijen_users` WHERE email = :email";
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

// Créer un nouvel utilisateur
function createUser($user) {
    $pdo = getConnexion();
    $sql = "INSERT INTO `ijen_users` (firstname, lastname, email, password, phone, communication, newsletter) VALUES (:firstname, :lastname, :email, :password, :phone, :communication, :newsletter)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $user['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $user['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $user['password'], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user['phone'], PDO::PARAM_STR);
        $stmt->bindParam(':communication', $user['communication'], PDO::PARAM_STR);
        $stmt->bindParam(':newsletter', $user['newsletter'], PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
        return false;
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

// // Mettre à jour un utilisateur
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

// // Supprimer un utilisateur
// function deleteUser($id) {
//     $pdo = getConnexion();
//     $sql = "DELETE FROM users WHERE id = :id";
//     try {
//         $stmt = $pdo->prepare($sql);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//         return $stmt->execute();
//     } catch(PDOException $e) {
//         echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
//         return false;
//     }
// }

?>