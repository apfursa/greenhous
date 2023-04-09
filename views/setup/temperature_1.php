<?php

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;

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
    <h4>Датчик температуры<?php //echo $datchId ?></h4>
</nav>
<?php
$datchObj = Datch::find()->where(['id' => $datchId])->one();
$max = $datchObj->max;
$min = $datchObj->min;
?>
<form action="https://apinjener.ru/setup/set-value-form" method="post">
    <label for="maxTemp">Максимальная температура</label>
    <input type="text" name="maxTemp" id="maxTemp" value="<?php echo $max ?>"><br>
    <label for="minTemp">Минимальная температура</label>
    <input type="text" name="minTemp" id="minTemp" value="<?php echo $min ?>"><br>
    <input type="hidden" name="datchId" value="<?php echo $datchId ?>"><br>
    <input type="submit" name="submit" value="Cохранить">
</form>
<?php //Yii::warning($datchId, '$datchId') ?>
<!--<h2> --><?php //echo $datchId ?><!--</h2>-->
</body>
</html>