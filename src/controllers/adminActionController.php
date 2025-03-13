<?php 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'models/users.php';

    if($_POST['DB_table'] === 'users') {

        switch($_POST['action']) {
            case 'create':
                echo "test CREATE user account par Admin";
                break;
                
            case 'update':
                echo "test UPDATE user account par Admin";
                break;
                    
            case 'delete':
                echo "test DELETE user account par Admin";
                break;
                        
            default:
                echo "Action inconnue";
        }

    } elseif($_POST['DB_table'] === 'products') {

        switch($_POST['action']) {

            case 'create':
                echo "test CREATE product par Admin";
                break;
                
            case 'update':
                echo "test UPDATE product par Admin";
                break;
                    
            case 'delete':
                echo "test DELETE product par Admin";
                break;
                            
            default:
                echo "Action inconnue";
        }
    }
}
?>