<?php
    require_once 'assets/php/headerindex.php';
?>
<div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header bg-dark">
                            <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;BACKMEDICALSOFT </h3>
                        </div>
                        <div class="card-body bg-info">
                            <form action="" method="post" class="px-3" id="login-form">
                                <div id="LoginAlert"></div>
                                <div class="form-group">
                                    <input type="text" name="login" class="form-control form-control-lg" placeholder="Login utilisateur" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Mot de passe utilisateur" required>
                                </div>
                                <div class="form-group">
                                    <select name="fonction_id" id="fonction_id" class="form-control form-control-lg" required>
                                        <?php $req=$db->query("SELECT * FROM roles");
                                            while ($tab=$req->fetch()){?>
                                                <option value="<?php echo $tab['id'];?>"><?php echo $tab['roles'];?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="valider" class="btn btn-dark btn-block btn-lg" value="Se connecter" id="LoginBtn" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    require_once 'assets/php/footer.php';
?>
<script type="text/javascript">
     $(document).ready(function(){
        $("#LoginBtn").click(function(e){
          if($("#login-form")[0].checkValidity()){
              e.preventDefault();
              
              $(this).val('Veuillez patientier...');
              $.ajax({
                  url : 'assets/php/action.php',
                  method : 'post',
                  data : $("#login-form").serialize()+'&action=login',
                  success:function(response){
                      if(response ==='login_log'){
                          window.location = 'backy/accueil.php';
                      }
                      else{
                          $("#LoginAlert").html(response);
                      }
                      window.location = 'backy/accueil.php';
                      $("#LoginBtn").val('Se connecter');
                  }
              });
          }  
        });
     });
 </script>
</body>
</html>