<?php

use classes\DB;

var_dump($user);
$db = new DB();
$db->connect();
$users = $db->fetch_assoc("SELECT * FROM users where Username ='$user' ");
// var_dump($users);

?>

<html>
<table class="table">
    <thead>
        <tr>
            <th>Ho va Ten</th>
            <th>Trang thai</th>
            <th>Quyen</th>
            <th>So bai viet</th>
        </tr>
    </thead>

    <body>
        <?php foreach ($users as $item) {

        ?>
            <tr>
                <td>
                    <?= $item["HoTen"] ?></a>
                </td>
                <td>
                    <?= $item["Active"] ?></a>

                </td>
                <td>
                    <?= $item["idGroup"] ?></a>
                </td>

            </tr>
        <?php } ?>

    </body>
</table>


</html>