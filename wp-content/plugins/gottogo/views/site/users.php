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
<div style="background: white;">
    <div>
        <h1>Потребители</h1>
        Тук ще има текст.
    </div>
    <div id="users">
        <?php
        $users = getAllRegisteredUsers();
        if (empty($users)) {
            ?>
            Няма регистрирани потребители.
        <?php
        } else {
            ?>
            <div id="users">
                <table class="table table-hover">
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
                            <td style="width: 40%;">
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
