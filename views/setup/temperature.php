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
    <title>Датчик температуры</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h4>Датчик температуры</h4><h6><?php echo $datchId ?></h6>
</nav>
<?php
$datchObj = Datch::find()->where(['id' => $datchId])->one();
$errorObj = Error::find()->where(['datchId' => $datchId])->one();
//$clientObj = Error::getClient($datchId);
$arrObjPokazaniya = Pokazaniya::find()->where(['datchId' => $datchId])->all();
$pokazaniyaObj = end($arrObjPokazaniya);
$time = strtotime($pokazaniyaObj->date);
$max = $datchObj->max;
$min = $datchObj->min;
$noCallTime = strtotime($errorObj->dateStartCall);
?>
<p>Текущие показания: <?php echo $pokazaniyaObj->value ?></p>
<p>Дата и время: <?php echo date("d.m.Y H:i:s", $time)?></p>
<form action="https://apinjener.ru/setup/set-value-form" method="post">
    <label for="maxTemp">Максимальное значение</label>
    <input type="text" name="maxTemp" id="maxTemp" value="<?php echo $max ?>" size="2"><br><br>
    <label for="minTemp">Минимальное значение</label>
    <input type="text" name="minTemp" id="minTemp" value="<?php echo $min ?>" size="2"><br>
    <label for="inactiv">Не звонить до:</label><br>
    <?php echo date("d.m.Y H:i:s", $noCallTime)?><br><br>
    <input type="date" id="inactiv" name="inactiv" size="1">
    <input type="time" id="inactivTime" name="inactivTime" size="1"><br><br>
    <input type="hidden" name="datchId" value="<?php echo $datchId ?>">
    <input type="submit" name="submit" value="Cохранить">
</form>
</body>


</html>