<?php
    $user = new User();
?>
    <a href="?mode=edit&id=0">Opret</a>
    <div class="table-responsive content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <?php foreach($user->listUsers() as $value): ?>
            <tr>
                <th scope="row"><?php echo $value["user_id"] ?>
                <td>
                    <?php echo $value["username"] ?>
                </td>
                <td>
                    <?php echo $value["first_name"] ?>
                </td>
                <td>
                    <?php echo $value["last_name"] ?>
                </td>
                <td>
                <button type="button" name="" id="" onclick="showUserDetails(<?php echo $value['user_id']?>)" class="btn btn-primary" btn-lg btn-block>Details</button>
                <button type="button" name="" id="" onclick="editUser(<?php echo $value['user_id']?>)" class="btn btn-primary" btn-lg btn-block>Edit </button>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>