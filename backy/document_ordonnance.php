<?php
    require_once '../assets/php/header.php';

    require_once '../assets/php/voirordonnance.php';

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
                <h4><B>REPUBLIQUE DEMOCRATIQUE DU CONGO</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°:<?=$vP;?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../assets/images/rdclogo.jpg" width="20%" height="3%" style="border-radius: 5%;"><br>
                </h4> 
                PRESIDENCE DE LA REPUBLIQUE <br>
                GARDE REPUBLICAINE <br>
                13ème REGIMENT <br>
                HOPITAL MILITAIRE DE GARNISON RUASHI
                </p> 
        </div>
    </div> <br/> <br/>
    <div class="section-headline text-center">
           <h1 class="nepaimprimer"><center><B><U>PRESCRIPTION MEDICALE N°:<?=$vid;?></B></U></center></h1><br>
    </div> <br/>
    <div class="text-left">
        <p>Nom du Médecin :................................</p> 
        <p>Nom du Malade :&nbsp;<b><?=$vnom;?></b></p>
        <p>Age :&nbsp;<b><?=$vage;?></b>&nbsp;ans</p> 
        <p>Sexe :&nbsp;<b><?=$vsexe;?></b></p>
    </div> <br/>
    <div class="section-headline">
        <table class="table table-sm table-bordered text-justify">
            <tr>
                <td>
                        <center>DESCRIPTION </center>
                </td>
            </tr>
            <tr>
                <td>
                     
                    <p><?=$vdescription;?></p>
                     
                </td>
            </tr>
        </table>
        <br />
        <div class="text-justify"></div>
        <div class="text-right"><p>Fait à Lubumbashi <?=$var;?></p></div> <br/>
        <div class="text-right"><p>Signature du Médecin</p></div>
    </div>
</div>
<?php
    require_once '../assets/php/footer.php';
?>
</body>
</html>