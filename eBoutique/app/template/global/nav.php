<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Pupuce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="catalog.php">Catalogue</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="account.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mon compte <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])){ echo " - ".$_SESSION['user']['LOGIN'];} ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php if(!isset($_SESSION['user'])){ ?>
          <a class="dropdown-item" href="register.php">S'inscrire</a>
          <a class="dropdown-item" href="login.php">Se connecter</a>
          <?php 
          }
          if(isset($_SESSION['user']['LOGIN']) && !empty($_SESSION['user']['LOGIN'])){ 
          ?>
            <a class="dropdown-item" href="account.php">Mon compte</a>
            <a class="dropdown-item" href="disconnect.php">Se déconnecter</a>
          <?php }?>
        </div>
      </li>
    </ul>
  </div>
</nav>