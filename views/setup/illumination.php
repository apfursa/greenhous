<?php

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use app\models\Pokazaniya;
use app\models\Error;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <title>Датчик освещенности</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h4>Датчик освещенности</h4><h6> <?php echo $datchId ?></h6>
</nav>
<?php
$datchObj = Datch::find()->where(['id' => $datchId])->one();
$errorObj = Error::find()->where(['datchId' => $datchId])->one();
$pokazaniyaObj = Pokazaniya::find()->where(['datchId' => $datchId])->orderBy(['id' => SORT_DESC])->limit(1)->one();
$time = strtotime($pokazaniyaObj->date);
$max = $datchObj->max;
$min = $datchObj->min;
$noCallTime = strtotime($errorObj->dateStartCall);
$dateForJS = date("Y-m-d", $noCallTime);
$timeForJS = date("H:i", $noCallTime);
?>
<p>Текущие показания: <?php echo $pokazaniyaObj->value ?></p>
<p>Дата и время: <?php echo date("d.m.Y H:i:s", $time)?></p>
<form action="https://apinjener.ru/setup/set-value-form" method="post">
    <label for="maxTemp">Максимальное значение</label>
    <input type="text" name="maxTemp" id="maxTemp" value="<?php echo $max ?>" size="2"><br><br>
    <label for="minTemp">Минимальное значение</label>
    <input type="text" name="minTemp" id="minTemp" value="<?php echo $min ?>" size="2"><br><br>
    <label for="inactive">Не звонить до:</label><br>
    <input type="date" id="inactive" name="inactive" value="<? echo $dateForJS ?>" size="1">
    <input type="time" id="inactiveTime" name="inactiveTime" value="" size="1"><br><br>
    <input type="hidden" name="datchId" value="<?php echo $datchId ?>">
    <input type="submit" name="submit" value="Cохранить">
</form>
</body>
<script>
    // Вывод даты по умолчанию в поле <input type="date">
    let date = "<?php echo $dateForJS ?>";
    document.querySelector("#inactive").value = date;
    // Вывод времени по умолчанию в поле <input type="time">
    let time = "<?php echo $timeForJS ?>";
    document.querySelector("#inactiveTime").value = time;
</script>
</html>