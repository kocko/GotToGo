<?php
    session_start();

    include_once 'head.php';

    include_once '../utils/trip_utils.php';

?>

<script>
    function deleteMyTrip(tripId) {
        bootbox.confirm("Сигурни ли сте, че искате да изтриете пътуването?", function(result) {
            if (result) {
                jQuery.post("<?= get_site_url(); ?>/wp-content/plugins/gottogo/views/site/delete_trip_action.php",
                    { tripId: tripId },
                    function (result) {
                        if (result == 1) {
                            location.reload();
                        } else {

                        }
                    }
                );
            }
        });
    }
</script>
<!-- TODO: fix the background! -->
<div style="background: white;">
    <div>
        <h1>Моите пътувания</h1>
        Тук ще има текст.
    </div>
    <div id="kocko">
<?php
    $trips = getTripsForCurrentUser($_SESSION['user']['id']);
    if (empty($trips)) {
    ?>
        Все още нямате създадени пътувания.
    <?php
    } else {
        ?>
        <div id="myTrips">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i <= count($trips); $i++) {
                    ?>
                    <tr>
                        <td>
                            <?= $trips[$i - 1]['id']; ?>
                        </td>
                        <td>
                            <?php
                            echo $trips[$i - 1]['destination'];
                            ?>
                        </td>
                        <td style="width: 40%;">
                            <button type="button" class="btn btn-primary btn-xs" id="tripPreview" title="Редактирай">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                Редактиране
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
                                Копиране
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" id="tripPreview" title="Изтрий" onclick="deleteMyTrip(<?= $trips[$i - 1]['id']; ?>)">
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
