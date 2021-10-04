<?php
include 'private/connectioncineflex.php';

$id = $_POST['film_id'];

$sql = "SELECT * 
        FROM films";
$stmt = $conn->prepare($sql);
$stmt->execute();

$sql2 = "SELECT * 
         FROM zalen";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
?>
<br><br>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <div class="text-light">
        <h1>Films inplannen</h1>
        <form class="maxform" action="php/filmsplan.php" method="post" enctype="multipart/form-data">
            <div class="user-box">
                <label>Titel</label>
                <select name="film" class="form-control" id="film">
                    <?php 
                    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $r['titel'] ?>"><?= $r['titel'] ?></option><?php
                    } ?>
                </select>
                <label>Zaal</label>
                <select name="zaal" class="form-control" id="zaal">
                    <?php 
                    while ($r2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $r2['zaal_id'] ?>"><?= $r2['zaal_id'] ?></option><?php
                    } ?>
                </select>
                <label>Start tijd</label>
                <input type="time" name="start" class="form-control" min="10:00" max="02:00" required>
            </div>
        <br>
        <button class="btn-success" type="submit">Submit</button>
    </form>
</div>


