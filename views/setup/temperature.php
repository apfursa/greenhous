<?php

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Datch;
use app\models\Pokazaniya;
use app\models\Error;
use app\models\Link;

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
<!--<hr>-->
<?php
$datchObj = Datch::find()->where(['id' => $datchId])->one();
$errorObj = Error::find()->where(['datchId' => $datchId])->one();
//$clientObj = Error::getClient($datchId);
$pokazaniyaObj = Pokazaniya::find()->where(['datchId' => $datchId])->orderBy(['id' => SORT_DESC])->limit(1)->one();
//Yii::warning(ArrayHelper::toArray($arrObjPokazaniya), '$arrObjPokazaniya');
//$pokazaniyaObj = end($arrObjPokazaniya);
//Yii::warning(ArrayHelper::toArray($pokazaniyaObj), '$pokazaniyaObj');
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
<br>
<?php
$linkAddress = Link::find()->where(['datchId' => $datchId])->all();
if($linkAddress){
    foreach($linkAddress as $linkOne)
    {
        if($linkOne['period'] == 'hour') $hrefHour = $linkOne['linkAddress'];
        if($linkOne['period'] == 'day') $hrefDay = $linkOne['linkAddress'];
        if($linkOne['period'] == 'week') $hrefWeek = $linkOne['linkAddress'];
    }

}else{
    $hrefHour = '#';
    $hrefDay = '#';
    $hrefWeek = '#';
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button style="border-radius: 10%; border: solid 1px black">
    <a href="<?php echo $hrefHour ?>" style="color: black">Час</a>
</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button style="border-radius: 10%; border: solid 1px black">
    <a href="<?php echo $hrefDay ?>" style="color: black">Сутки</a>
</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button style="border-radius: 10%; border: solid 1px black">
    <a href="<?php echo $hrefWeek ?>" style="color: black">Неделя</a>
</button>
<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--    <h5>График</h5>-->
<!--</nav>-->
<!--<hr>-->
<!--<form action="https://apinjener.ru/setup/graphic" method="post">-->
<!--    <input type="radio" name="graphic" id="60min" value="60">-->
<!--    <label for="60min">60 минут</label>-->
<!--    <input type="radio" name="graphic" id="24hours" value="24">-->
<!--    <label for="24hours">24 часа</label>-->
<!--    <input type="radio" name="graphic" id="week">-->
<!--    <label for="week">Неделя</label><br>-->
<!--    <input type="hidden" name="datchId" value="--><?php //echo $datchId ?><!--"><br>-->
<!--    <input type="submit" name="submit" value="Показать">-->
<!--</form>-->

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