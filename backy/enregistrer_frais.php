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
            <span class="text-light lead align-self-center"><i class="fa fa-pen"></i>&nbsp;Tous les Frais Patients</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addFraisModal"><i class="fa fa-pen"></i>&nbsp;Ajouter Frais Patient</a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="afficherFrais">
                <p class="text-center lead mt-5">Veuillez patienter...</p>
            </div>
        </div>
    </div>
</div>
<!--Début d'Ajout frais patients-->
<div class="modal fade" id="addFraisModal">
    <div class="modal-dialog modal-dialog-justify col-lg-16">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light"><i class="fas fa-pen"></i>&nbsp;Ajouter Frais</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form  action="#" method="post" id="add-frais-form" class="px-3">
                    <div id="userAlert" class="text-danger text-center mt-2 font-weight-bold"></div>
                    <div class="form-group">
                        <input type="text" name="type_frais" id="type_frais" class="form-control form-control-lg" placeholder="Entrer type frais" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="number" name="prix_unitaire" id="prix_unitaire" class="form-control form-control-lg" placeholder="Entrer prix unitaire" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="qte" id="qte" class="form-control form-control-lg" placeholder="Entrer qte" required>
                    </div>
                    <div class="form-group">
                        <label for="patient_frais_id">Sélectionner Patient:</label>
                        <select name="patient_frais_id" id="patient_frais_id" class="form-control form-control-lg" required>
                            <?php $req=$db->query("SELECT * FROM patient");
                                while ($tab=$req->fetch()){?>
                                    <option value="<?php echo $tab['id_patient'];?>"><?php echo $tab['nom'];?>&nbsp;|&nbsp;<?php echo $tab['prenom'];?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addFrais" class="btn btn-dark btn-block btn-lg" id="addFraisBtn" value="Ajouter Frais" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin d'Ajout frais patients-->
<?php
    require_once '../assets/php/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        
        //Afficher voir  frais  en Ajax Request
        $("body").on("click", ".infoFraisBtn", function(e){
                e.preventDefault();
                detail_frais_id=$(this).attr('id');
                $.ajax({
                    url: '../assets/php/enregistrer_frais-process.php',
                    type:'post',
                    data:{detail_frais_id:detail_frais_id},
                    success:function(response){
                        window.location ='documents_frais.php?id='+detail_frais_id;
                    }
                });
        });

        //Ajouter frais patient en Ajax Request
        $("#addFraisBtn").click(function(e){
            if($("#add-frais-form")[0].checkValidity()){
                e.preventDefault();
                $("#addFraisBtn").val('Veuillez patienter...');
                $.ajax({
                    url:'../assets/php/enregistrer_frais-process.php',
                    method:'post',
                    data:$("#add-frais-form").serialize()+'&action=add_frais',
                    success:function(response){
                            $("#addFraisBtn").val('Ajouter Frais');
                            $("#add-frais-form")[0].reset();
                            $("#addFraisModal").modal('hide');
                            Swal.fire({
                                title:'Frais ajouté avec succès !',
                                type:'success'
                            });
                            afficherFraisPatients();
                    }
                });
            }
        });

        //Delete Frais patient 
        $("body").on("click", ".deleteFraisIcon", function(e){
            e.preventDefault();

            del_frais_id=$(this).attr('id');

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
                            url:'../assets/php/enregistrer_frais-process.php',
                            method:'post',
                            data:{del_frais_id:del_frais_id},
                            success:function(response){
                                Swal.fire(
                                    'Supprimé Frais Patient !',
                                    'Frais Patient supprimé avec succès.',
                                    'success'
                                )
                                afficherFraisPatients();
                            }
                        });
                        
                    }
                })

        });

        //Fetch All frais patient Ajax Request
        afficherFraisPatients();

        function afficherFraisPatients(){
            $.ajax({
                url:'../assets/php/enregistrer_frais-process.php',
                method: 'post',
                data:{action: 'afficherFraisPatients'},
                success:function(response){
                    $("#afficherFrais").html(response);
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