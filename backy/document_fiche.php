<?php
    require_once '../assets/php/header.php';

    require_once '../assets/php/voirfiches.php';

    setlocale(LC_TIME,'fr');
    $var=ucfirst(strftime('%A, le %d %B %Y'));
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
           <a href="" class="nepaimprimer" onclick="window.print();">Imprimer</a>
        </div>
        <div class="section-headline text-justify">
                <p align="left">
                <h4><B>REPUBLIQUE DEMOCRATIQUE DU CONGO</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N° DOSSIER:<?=$vdossier;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/images/rdclogo.jpg" width="20%" height="3%" style="border-radius: 5%;"><br>
                </h4> 
                PRESIDENCE DE LA REPUBLIQUE <br>
                GARDE REPUBLICAINE <br>
                13ème REGIMENT <br>
                HOPITAL MILITAIRE DE GARNISON RUASHI
                </p> 
        </div>
    </div>
    <div class="section-headline text-center">
           <h1 class="nepaimprimer"><center><B><U>FICHE MEDICALE N°:<?=$vid;?></B></U></center></h1><br>
    </div>
    <div class="section-headline">
        <table class="table table-sm text-justify">
            <tr width="50%">
                <td>Nom :&nbsp;<?=$vnom;?></td>
                <td>Post-nom :&nbsp;<?=$vpostnom;?></td>
            </tr>
            <tr width="50%">
                <td>Prénom :&nbsp;<?=$vprenom;?></td>
                <td>Téléphone :&nbsp;<?=$vtel;?></td>
            </tr>
            <tr width="50%">
                <td>Date de naissance :&nbsp;<?=$vdate;?></td>
                <td>Sexe:&nbsp;<?=$vsexe;?></td>
            </tr>
            <tr width="50%">
                <td>Adresse :&nbsp;<?=$vadresse;?></td>
                <td>Profession :&nbsp;<?=$vprofession;?></td>
            </tr>
            <tr width="50%">
                <td>Employeur :&nbsp;.......................</td>
                <td>Matricule :&nbsp;.......................</td>
            </tr>
            <tr width="50%">
                <td>Hospitalisation: Date d'entrée:&nbsp;<?=$vdate_entree;?></td>
                <td>Service :&nbsp;.........................</td>
            </tr>
            <tr width="50%">
                <td>Date de sortie :&nbsp;.......................</td>
                <td>Lit N°:&nbsp;................................ </td>
            </tr>
        </table>
        <table class="table table-sm table-bordered text-justify">
            <tr>
                <td>DATE</td>
                <td>SYMPTOMES/EXAMENS CLINIQUES/LABO/DIAGNOSTIC/TRAITEMENT</td>
            </tr>
            <tr>
                <td>&nbsp;<?=$vdate_fiche;?></td>
                <td>&nbsp;<?=$vdescription;?></td>
            </tr>
        </table>
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>