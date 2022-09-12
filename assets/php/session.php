<?php
session_start();
require_once 'auth.php';
$cuser=new Auth();

//Session BACKYMEDICALSOFT
if(!isset($_SESSION['user'])){
    header('location:../index.php');
    die;
}
    $clogin=$_SESSION['user'];
    
    $data=$cuser->currentUser($clogin);

    $cid=$data['id'];
    $cfonction_id=$data['fonction_id'];
    $croles=$data['roles'];
    $cmatricule=$data['matricule'];

    if($cfonction_id==1){
        $cfonction_id='Medecin';
    }
    else if($cfonction_id==2){
        $cfonction_id='Comptable';
    }
    else if ($cfonction_id==3){
        $cfonction_id='Infirmier';
    }
    else if($cfonction_id==4){
        $cfonction_id='Receptionniste';
    }
    else{
         $cfonction_id='Laborantin';
    }

?>