<?php

    session_start();
    require_once 'auth.php';
    $user=new Auth();

    //Gérer l'authentification de l'utilisateur Login Ajax Request
    if(isset($_POST['action'])&& $_POST['action']=='login'){
        $login=$user->test_input($_POST['login']);
        $password=$user->test_input($_POST['password']);
        $fonction_id=$user->test_input($_POST['fonction_id']);

        $loggedInUser=$user->loginUser($login,$password,$fonction_id);

        if($loggedInUser !=null){
            $_SESSION['user']=$login;
        }
        else{
            echo $user->showMessage('danger', 'Login, Mot de passe et Rôle utilisateur est Incorrect!');
        }
    }

?>