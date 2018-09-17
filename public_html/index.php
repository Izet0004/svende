<?php
$pageTitle = "Vandrestøvlen";
$errorMsg = "";
$username = "";
$password = "";
$roleId = 0;
$errorLogin = false;
include_once("assets/incl/init.php");
// echo password_hash("bob", PASSWORD_DEFAULT);
if(isset($_POST["logout"])){
  session_unset();
  session_regenerate_id();
  header("location: index.php");
  exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])){
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
            header("location: admin/index.php");
            exit();
          } else if($auth->isMember()){
            header("location: index.php");
            exit();
          }
        } else {
          $errorLogin = true;
          $errorMsg = "Forkerte oplysninger.";
        }
      }
    }
    include_once("assets/incl/header.php");
?>
  <div class="container">
    <section class="row">
      <div class="col-lg-7 p-0">
        <img class="img-fluid" style="width: 100%;" src="assets/images/grass.jpg" alt="grass">
      </div>
      <div class="col-lg-5 bg-green">
        <article class="center-fix">
          <h1 class="weight-1000">Velkommen til Vandrestøvlen</h1>
          <p>
            Vandrestøvlen er en lille klub for personer, der gerne vil gå ture i naturen og samtidig få informationer om det område.,
            som man går i. For at kunne tilmelde sig forskellige arrangmeneter skal du være medlem - det er
            <b>gratis</b>
          </p>
        </article>
      </div>
    </section>
    <div class="row justify-content-center pad-top-2 pad-left-05">
      <div class="col-lg-9 p-2">
        <h3 class="weight-1000 font-32">Kommende arrangmeneter</h3>
      </div>
    </div>
    <section class="row soon-events justify-content-center">
      <figure class="col-lg-3">
        <figcaption class="pad-side-1">
          <b>KALØ SLOTSRUN</b>
        </figcaption>
        <img src="assets/images/bjerge.jpg" alt="bjerge" class="img-fluid">
        <div>
          <ul>
            <li>
              <b>MOTIONIST</b>
            </li>
            <li>Den 23. apil 2017</li>
          </ul>
          <a href="#" class="btn-black">LÆS MERE</a>
        </div>
      </figure>
      <figure class="col-lg-3">
        <figcaption class="pad-side-1">
          <b>KALØ SLOTSRUN</b>
        </figcaption>
        <img src="assets/images/bjerge.jpg" alt="bjerge" class="img-fluid">
        <div>
          <ul>
            <li>
              <b>MOTIONIST</b>
            </li>
            <li>Den 23. apil 2017</li>
          </ul>
          <a href="#" class="btn-black">LÆS MERE</a>
        </div>
      </figure>
      <figure class="col-lg-3">
        <figcaption class="pad-side-1">
          <b>KALØ SLOTSRUN</b>
        </figcaption>
        <img src="assets/images/bjerge.jpg" alt="bjerge" class="img-fluid">
        <div>
          <ul>
            <li>
              <b>MOTIONIST</b>
            </li>
            <li>Den 23. apil 2017</li>
          </ul>
          <a href="#" class="btn-black">LÆS MERE</a>
        </div>
      </figure>
    </section>
    <div class="row justify-content-center pad-top-2 pad-left-05">
      <div class="col-lg-9 p-2">
        <a href="#" class="weight-1000  btn-black">KLIK HER FOR FLERE ARRANGEMENTER</a>
      </div>
    </div>
    <?php
include_once("assets/incl/footer.php");
?>
  </div>