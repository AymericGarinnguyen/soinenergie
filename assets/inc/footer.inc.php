 </section>
 </main>

 <!-- Modal User-->
 <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form class="modal-content formRappel" method="post" action="<?= $_SERVER['PHP_SELF']; ?>" novalidate>
             <div class="modal-header">
                 <h5 class="modal-title" id="modalLabel">Connexion</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div> <!-- Fin div.modal-header -->

             <div class="modal-body">
                 <?= $content; ?>
                 <input type="text" class="form-control mb-2" name="nom" id="nom_sms" placeholder="Nom">
                 <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
             </div> <!-- Fin div.modal-body -->

             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Annuler</button>
                 <input type="submit" class="btn btn-primary btn-sm" name="connexion" value="Connexion" id="connexion">
             </div> <!-- Fin div.modal-footer -->
         </form>
     </div> <!-- Fin div.modal-dialog -->
 </div> <!-- Fin div.modal.fade -->
 <!-- Fin Modal -->

 <footer class="footer mt-auto">
     <div class="row justify-content-center">
         <div class="ft-contact order-2 order-md-1 col-sm-12 col-md-6 col-lg-4">
             <img src="assets/img/<?= $_SESSION['accueil']['contact'] ?>" alt="logo pour le lien contact, deux mains colorées tendues l'une vers l'autre">
             <a data-toggle="modal" data-target="#modal_contact"><?= $_SESSION['accueil']['contactBtn'] ?></a>
         </div>
         <?php if (strpos($_SERVER['PHP_SELF'], 'don') != true) : ?>
             <div class="ft-don order-1 order-md-2 col-sm-12 col-md-6 col-lg-4">
                 <img src="assets/img/<?= $_SESSION['accueil']['don'] ?>" alt="logo pour le lien don, une main versant une pièce vers une autre main">
                 <a href="<?= (strpos($_SERVER['HTTP_HOST'],'localhost') === 0) ? "don.php" : "don" ?>"><?= $_SESSION['accueil']['donBtn'] ?></a>
             </div>
         <?php endif; ?>
     </div>
     <div class="d-flex mon-footer">
         <div class="infos">
             <div class="remerciement">
                 Remerciements :
                 <ul class="noms">
                     <li>3 Joyaux <i class="fas fa-circle"></i></li>
                     <li>MaLotte <i class="fas fa-circle"></i></li>
                     <li>JM.Folon</li>
                 </ul>
                 <span>-</span>
             </div>
             <div class="programmation">
                 Programmation : <a href="mailto:aymeric.garin@yahoo.fr">aymeric.garin@yahoo.fr</a>
             </div>
         </div>
         <div class="align-self-center back-admin">
             <a data-toggle="modal" data-target="#my_modal"><img src="assets/img/logo_voix_vivantes_blanc.png" alt="Logo du site lucy-soinenergie.fr"></a>
         </div>
     </div>
 </footer>
 </div>
 </div> <!-- div.container.principale -->


 <?php include 'script.inc.php'; ?>