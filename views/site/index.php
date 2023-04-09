<?php
namespace app\views\site;

use Yii;
use yii\helpers\ArrayHelper;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <title>Главная страница</title>
</head>
<body>
<!--<div class="bg-warning" style="text-align:center"><strong><b><h2>Проблемы с электропитанием</h2></b></strong></div>-->

<div class="col" style="background: #dfd">
    <?php
    foreach ($ob as $keyObj => $valObj) { ?>
        <div class="col"
             style="font-size:24px;border-bottom: 3px solid silver; background: #FFFF00; height: 40px; color:#696969">
            <b><?php echo $keyObj ?></b>
        </div>
        <div class="row mb-1">
            <?php
            foreach ($valObj as $keyPl => $valPl) {
                foreach ($valPl as $keyDat => $valDat) {
                    ?>
                    <div class="col">
                        <div class="col" style="font-size:20px">
                            <a href="https://apinjener.ru/setup/param?datchId=<?php echo $valDat['datchId'] ?>"><?php echo $keyDat ?></a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col" style="font-size:25px; text-align: right">
                            <i style="color: <?php echo $valDat['colorVal'] ?>"><b><?php echo $valDat['value'] ?></b></i>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<div class="col" style="background: #FFFF00">
<?php
$id = Yii::$app->user->id;
if (!$id) {
    ?>
    <img src="https://apinjener.ru/web/uploads/tepl.jpg" alt="Итальянские Трулли" width="100%">
<?php }
?>
</body>
</html>
