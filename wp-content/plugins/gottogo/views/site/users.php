<?php
include_once 'head.php';

include_once '../utils/user_utils.php';

?>
<script>
    function deleteUser(userId) {
        bootbox.confirm("Сигурни ли сте, че искате да изтриете потребителя?", function(result) {
            if (result) {
                jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/delete_user_action.php",
                    { userId: userId },
                    function (result) {
                        if (result == 1) {
                            location.reload();
                        }
                    }
                );
            }
        });
    }
</script>
<div class="row" id="editProfile" aria-expanded="false" aria-controls="editProfileCollapse" >
    <div class="col-xs-12 col-md-6">
        <div class="well" style="width: 1330px; margin-left: 30%; margin-right: auto;">
            <div align="center">
                <h1 style="font-size: 3em;">Потребители</h1>
                <div style="width: 90%; font-size: 18px;">
                   Вие се намирате в административния панел на приложението, като имате достъп до изтриването на потребители, регистрирали се в системата.
                </div>
            </div>
            <div class="row" style="height: 15pt;"></div>
            <div id="users">
                <?php
                $users = getAllRegisteredUsers();
                if (empty($users)) {
                    ?>
                    Няма регистрирани потребители.
                <?php
                } else {
                    ?>
                    <div id="users" align="center">
                        <table style="width: 60%;">
                            <thead>
                            <th>Име</th>
                            <th>Е-mail</th>
                            <th></th>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 1; $i <= count($users); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $users[$i - 1]['fullname']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $users[$i - 1]['email'];
                                        ?>
                                    </td>
                                    <td style="width: 10%;">
                                        <button type="button" class="btn btn-danger btn-xs" id="deleteUserButton" title="Изтрий" onclick="deleteUser(<?= $users[$i - 1]['id']; ?>)">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            Изтриване
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
