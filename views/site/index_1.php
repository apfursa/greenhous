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

<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--    <h1 style="background: #f2ede3">Главная страница</h1>-->
<!--</nav>-->


<div class="col" style="background: #f2ede3">
    <!--<div>-->
    <?php foreach ($ob as $keyObj => $valObj) {
//        Yii::warning($ob, '$ob2');
        ?>
        <div class="col"
             style="font-size:24px;border-bottom: 4px solid silver; background: #FFFACD; height: 40px; color:#696969">
            <b><?php echo $keyObj ?></b>
        </div>
        <div class="row mb-1">
            <?php
            foreach ($valObj as $keyPl => $valPl) {
//                Yii::warning($valObj, '$valObj###');
//                Yii::warning($valPl, '$valPl###');
                foreach ($valPl as $keyDat => $valDat) {
//                    Yii::warning($valDat, '$valDat----!!');
                    ?>
                    <div class="col">
                        <div class="col" style="font-size:20px">
                            <a href="https://apinjener.ru/setup/param?datchId=<?php echo $valDat['datchId'] ?>"><?php echo $keyDat ?></a>
                        </div>
                    </div>
                    <?php
                    //$s = ArrayHelper::getValue($array, $key);
                    //foreach ($valDat as $keyPok => $valPok) {
                    //Yii::warning($valPok, '$valPok----!!');
                    ?>
                    <div class="col">
                        <div class="col" style="font-size:25px; text-align: right">
                            <?php //echo $valDat['value']  ?>
                            <i style="color: <?php echo $valDat['colorVal'] ?>"><?php echo $valDat['value'] ?></i>
                        </div>
                    </div>
                    <?php //}  ?>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <!--                <div class="row mb-1">
                        <div class="col">
                            <div class="col" style="font-size:20px">
                                Влажность
                            </div>
                        </div>
                        <div class="col">
                            <div class="fixed-right; col" style="font-size:20px">
                                34
                            </div>
                        </div>
                    </div>
                </div><br>-->

    <!--            <div>
                    <div class="col" style="font-size:24px;border-bottom: 4px solid silver; background: #afa; height: 40px; color:#333">
                        <b>Теплица №2</b>
                    </div>
                    <div class="col" style="font-size:20px">
                        Температура
                    </div>
                    <div class="col" style="font-size:20px">
                        Влажность
                    </div>
                </div><br>-->

    <!--            <div>
                    <div class="col" style="font-size:24px">
                        <b>Теплица №3</b>
                    </div>
                    <div class="col" style="font-size:20px">
                        Температура
                    </div>
                    <div class="col" style="font-size:20px">
                        Влажность
                    </div>
                </div><br>-->

    <!--            <div>
                    <div class="col" style="font-size:24px">
                        <b>Теплица №4</b>
                    </div>
                    <div class="col" style="font-size:20px">
                        Температура
                    </div>
                    <div class="col" style="font-size:20px">
                        Влажность
                    </div>
                </div><br>-->

    <!--            <div>
                    <div class="col" style="font-size:24px">
                        <b>Теплица №5</b>
                    </div>
                    <div class="col" style="font-size:20px">
                        Температура
                    </div>
                    <div class="col" style="font-size:20px">
                        Влажность
                    </div>

                </div>-->
    <!--</div>-->
</div>


</body>
</html>
