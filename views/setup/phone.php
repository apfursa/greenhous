<?php

use app\models\Client;
use app\models\Objects;
use app\models\Plata;
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
    <title>Замена номера</title>
</head>


<body>
<style>
    .my-input {
        font: bold 14px;
        color: green;
        width: 200px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h4>Замена номера</h4><h6> <?php echo $datchId ?></h6>
</nav>
<?php
$plataId = Datch::find()->where(['id' => $datchId])->one()->plataId;
$objId = Plata::find()->where(['id' => $plataId])->one()->objectId;
$clientId = Objects::find()->where(['id' => $objId])->one()->clientId;
$clientObj = Client::find()->where(['id' => $clientId])->one()->telephone;
$phone = substr($clientObj, 5,10)
//$datchObj = Datch::find()->where(['id' => $datchId])->one();
//$max = $datchObj->max;
//$min = $datchObj->min;
//?>
<form action="https://apinjener.ru/setup/set-value-form" method="post">
    <label for="phone">Введите номер телефона</label>
    <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" size="12" class="my-input"><br><br>
    <input type="hidden" name="datchId" value="<?php echo $datchId ?>">
    <input type="checkbox" name="test" value="test1"> Проверка телефона <br><br>
    <input type="submit" name="submit" value="Cохранить">
</form>
<?php //Yii::warning($datchId, '$datchId') ?>
<!--<h2> --><?php //echo $datchId ?><!--</h2>-->
</body>
</html>