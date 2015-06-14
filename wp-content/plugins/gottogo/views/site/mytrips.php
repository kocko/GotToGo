<?php
    session_start();

    include_once 'head.php';

    include_once '../utils/trip_utils.php';

?>
<!-- TODO: fix the background! -->
<div style="background: white;">
    <div>
        <h1>Моите пътувания</h1>
        Тук ще има текст.
    </div>
<?php
    $trips = getTripsForCurrentUser($_SESSION['user']['id']);
    if (empty($trips)) {

    } else {
        ?>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Пътуване до:</th>
                    <th>Действия</th>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i <= count($trips); $i++) {
                    ?>
                    <tr>
                        <td>
                            <?= $i; ?>
                        </td>
                        <td>
                            <?php
                            echo $trips[$i - 1]['destination'];
                            ?>
                        </td>
                        <td style="width: 40%;">
                            <button type="button" class="btn btn-primary btn-xs" id="tripPreview" title="Редактирай">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                Редактирай
                            </button>
                            <button type="button" class="btn btn-info btn-xs" id="tripPreview" title="Преглед">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                Преглед
                            </button>
                            <button type="button" class="btn btn-success btn-xs" id="tripPreview" title="Печат">
                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                Печат
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" id="tripPreview" title="Копирай">
                                <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
                                Копирай
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" id="tripPreview" title="Изтрий">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                Изтрий
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
