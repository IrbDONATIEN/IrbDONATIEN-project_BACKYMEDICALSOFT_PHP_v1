<?php
    require_once '../assets/php/header.php';
    require_once '../assets/php/connexion.php';
?>
<div class="container mt-2">
    <div class="alert alert-dark alert-dismissible text-center mt-2 m-0">
        <div class="col-lg-15">
            <strong>Bienvenu(e) dans le système médicale BACKYMEDICALSOFT Rôles:<?=$croles;?>&nbsp;Matricule:&nbsp;<?=$cmatricule;?></strong>
        </div>
    </div>
    <hr>
    <div class="card border-dark mt-2">
        <h5 class="card-header bg-dark d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-sign"></i>&nbsp;Tous les examens des Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addExamensModal"><i class="fa fa-sign"></i>&nbsp;Ajouter Examen Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherExamens">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout d'examens Labo patients-->
<div class="modal fade" id="addExamensModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-business-time"></i>&nbsp;Ajouter Facture</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-examen-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="glycemie" id="glycemie" class="form-control form-control-lg" placeholder="Entrer glycemie" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="selles" id="selles" class="form-control form-control-lg" placeholder="Entrer selles" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="sang" id="sang" class="form-control form-control-lg" placeholder="Entrer sang" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="urines" id="urines" class="form-control form-control-lg" placeholder="Entrer urines" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="crachat" id="crachat" class="form-control form-control-lg" placeholder="Entrer crachat" required>
                    </div>
                    <div class="form-group">
                        <label for="signes_vitaux_id">Sélectionner Signes Vitaux Patient:</label>
                        <select name="signes_vitaux_id" id="signes_vitaux_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT id_signe,taille,poids,frequence,temperature,tension,patient_signe_id,patient.nom, patient.postnom, patient.prenom, dateCreation FROM signes_vitaux INNER JOIN patient ON signes_vitaux.patient_signe_id=patient.id_patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_signe'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?>|&nbsp;<?php echo $tab['taille'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addExamens" class="btn btn-dark btn-block btn-lg" id="addExamensBtn" value="Ajouter Examen Labo" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout d'examens patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){

        //Publier Examen Labo patient 
        $("body").on("click", ".publierExamensIcon", function(e){
            e.preventDefault();

            del_valider_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de publier ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3215d6',
                cancelButtonColor: '#d23',
                confirmButtonText: 'Oui, supprimez-le!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/examen_labo-process.php',
                            method:'post',
                            data:{del_valider_id:del_valider_id},
                            success:function(response){
                                Swal.fire(
                                    'Publié Examen Labo Patient !',
                                    'Publié Examen Labo Patient supprimé avec succès.',
                                    'success'
                                )
                                afficherExamensLaboPatients();
                            }
                        });
                        
                    }
                })

        });
    
        //Delete Examen Labo patient 
        $("body").on("click", ".deleteExamensIcon", function(e){
            e.preventDefault();

            del_examens_id=$(this).attr('id');

            Swal.fire({
                title: 'Etes-vous sûr de supprimer ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'../assets/php/examen_labo-process.php',
                            method:'post',
                            data:{del_examens_id:del_examens_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Examen Labo Patient !',
                                    'Examen Labo Patient supprimé avec succès.',
                                    'success'
                                )
                                afficherExamensLaboPatients();
                            }
                        });
                        
                    }
                })

        });
    
        //Ajouter examen labo patient en Ajax Request
        $("#addExamensBtn").click(function(e){
            if($("#add-examen-form")[0].checkValidity()){
                e.preventDefault();
                $("#addExamensBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/examen_labo-process.php',
                    method:'post',
                    data:$("#add-examen-form").serialize()+'&action=add_examens',
                    success:function(response){
                            $("#addExamensBtn").val('Ajouter Facture');
                            $("#add-examen-form")[0].reset();
                            $("#addExamensModal").modal('hide');
                            Swal.fire({
                                title:'Frais ajouté avec succès !',
                                type:'success'
                            });
                            afficherExamensLaboPatients();
                    }
                });
            }
        });


        //Fetch All Examens Labo des patients Ajax Request
        afficherExamensLaboPatients();

        function afficherExamensLaboPatients(){
            $.ajax({
                url:'../assets/php/examen_labo-process.php',
                method: 'post',
                data:{action: 'afficherExamensLaboPatients'},
                success:function(response){
                    $("#afficherExamens").html(response);
                    $("table").DataTable({
                        order:[0, 'desc']
                    });
                }
            });
        }
    });
</script>
</body>
</html>