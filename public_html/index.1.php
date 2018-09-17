<?php
$pageTitle = "Vandrestøvlen";
$errorMsg = "";
include_once("assets/incl/header.php");
?>
  <?php
$username = "";
$password = "";
$roleId = 0;
$errorLogin = false;
include_once("assets/incl/init.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"]))){
        $errorMsg = "Udfyld felterne.";
    } else {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    }

    if($errorLogin == false){
        $user = new User();
        if($user->checkUser($username, $password)){
            $auth->userId = $user->id;
            if($auth->isAdmin()){
                // header("location: admin/index.php");
                exit();
            } else if($auth->isMember()){
                // header("location: index.php");
                exit();
            }
        } else {
            $errorLogin = true;
            $errorMsg = "Forkerte oplysninger.";
            // header("location: index.php");
        }
    }
}
?>
    <section class="section-1">
      <div class="section-1-1">
        <div>
          <h1>Vandrestøvlen</h1>
        </div>
        <div>
          <img src="assets/images/grass.jpg" alt="grass">
        </div>
      </div>

      <div class="section-1-2">
        <div>
          <div class="">
            <div class="login">
              <div>
                <h2 class="inline p0-1 m0">DIN PROFIL</h2>
              </div>
              <div class="m0-2">
                <a href="">OPRET BRUGER</a>
                <a href="">GLEMT KODE</a>
              </div>
            </div>
              <?php echo '<label class="p0-2 red">'.$errorMsg.'</label>'?>
            <form class="credientials" method="POST" action="index.php">
              <input type="text" name="username" placeholder="BRUGERNAVN" id="">
              <input type="password" name="password" placeholder="PASSWORD" id="">
              <!-- <button>LOGIN</button> -->
              <input type="submit" value="LOGIN">
            </form>
          </div>
        </div>
        <article>
          <h1>Velkommen til Vandrestøvlen</h1>
          <p>
            Vandrestøvlen er en lille klub for personer, der gerne vil gå ture i naturen og samtidig få informationer om det område.,
            som man går i. For at kunne tilmelde sig forskellige arrangmeneter skal du være medlem - det er gratis
          </p>
        </article>
      </div>
    </section>
    <?php
// include_once("assets/incl/footer.php");
?>