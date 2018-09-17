<?php include_once("assets/incl/header.php")?>
<?php
$mode = filter_input(INPUT_POST, "mode", FILTER_SANITIZE_STRING);
if(empty($mode)) { $mode = filter_input(INPUT_GET, "mode", FILTER_SANITIZE_STRING);}
if(empty($mode)) { $mode = "list"; }

switch(strtoupper($mode)){
    default:
    $mode = "LIST";
    break;
    case "LIST":
    $product = new Product();
    echo '<table class="table">'.
    '<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Category</th>
      <th scope="col">Options</th>
    </tr>
    </thead>';
    foreach ($product->listproducts() as $value) {
        echo '<tr>';
        echo '<th scope="row">'.$value["id"].'';
        echo '<td>'.$value["name"].'</td>';
        echo '<td><img height="40" width="40" src="/assets/images/'.$value["image_path"].'"</td>';
        echo '<td>'.$value["category_name"].'</td>';
        echo '<td>
        <a href="?mode=details&id='.$value["id"].'">D</a>
        <a href="?mode=edit&id='.$value["id"].'">E</a></td>';
        echo '</tr>';
    }
    echo '</tbody>
    </table>';
    break;
    case "DETAILS":
    $id = (int)$_GET["id"];
    if($id > 0){
        $product = new Product();
        echo '<table class="table">'.
        '<thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Category</th>
          <th scope="col">Date Created</th>
          <th scope="col">Deleted</th>
        </tr>
        </thead>';
        foreach ($product->getProduct($id) as $value) {
            echo '<tr>';
            echo '<th scope="row">'.$value["id"].'';
            echo '<td>'.$value["name"].'</td>';
            echo '<td>'.$value["description"].'</td>';
            echo '<td>'.$value["category_name"].'</td>';
            echo '<td>'.$value["date_created"].'</td>';
            echo '<td>'.$value["is_deleted"].'</td>';
            echo '</tr>';
        }
        echo '</tbody>
        </table>';
    }
    break;
    case "EDIT":
    $id = (int)$_GET["id"];
    $product = new Product();
    
    $row = $product->getProductSingle($id);
    echo '<section>
    <form class="col-lg-7 mx-auto" action="?mode=save&id='.$product->id.'" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" value="' .$product->name. '" placeholder="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="" aria-describedby="helpId" value="' .$product->description. '" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastName" id="" aria-describedby="helpId" value="' .$product->lastName. '" placeholder="Last name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" value="' .$product->email. '" placeholder="Email">
            </div>
            <div class="form-group">
            <img src="/assets/images/userimages/' .$user->avatarPath. '" height="50px" width="50px">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" name="avatar" id="" aria-describedby="helpId" value="" placeholder="Image">
            </div>
            Role
            <div class="form-check">
            <input class="form-check-input" name="role" value="1" '. $checkAdmin .' type="radio">
            <label class="form-check-label" for="role">Admin</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" name="role" value="2" '. $checkMember .' type="radio">
            <label class="form-check-label" for="role">Member</label>
            </div>
            User options
            <div class="form-check">
                <input type="checkbox" name="isSuspended" '.$selected.' class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Suspend user</label>
            </div>
        <button type="submit" name="save" id="" class="btn btn-primary btn-lg btn-block">Gem</button>
    </form>
    </section>';
    break;
    case "SAVE":
    $id = (int)$_GET["id"];
    if($id > 0){
        // update
        $user = new User();
        $row = $user->getUserSingle($id);
        !empty($_POST["isSuspended"]) ? $suspend = 1 : $suspend = 0;
        if(!empty($_POST)){
            var_dump($_FILES["avatar"]);
            empty($_FILES["avatar"]["name"]) ? $avatarName = $user->avatarPath : $avatarName = $user->uploadUserAvatar($_FILES["avatar"]);
            $user->updateUser(
                filter_var($id, FILTER_SANITIZE_NUMBER_INT),
                filter_var($_POST["username"], FILTER_SANITIZE_STRING),
                filter_var($_POST["firstName"], FILTER_SANITIZE_STRING),
                filter_var($_POST["lastName"], FILTER_SANITIZE_STRING),
                filter_var($_POST["email"], FILTER_SANITIZE_STRING),
                filter_var($avatarName, FILTER_SANITIZE_STRING),
                filter_var($suspend, FILTER_SANITIZE_STRING),
                filter_var($_POST["role"], FILTER_SANITIZE_NUMBER_INT)
            );
        }
    } else {
        // insert
    }
    break;
    case "DELETE":
}

?>
    <?php include_once("assets/incl/footer.php")?>