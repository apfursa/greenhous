<?php

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

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <h1>Главная страница</h1>
        </nav>

        <div class="col">
            <!--<div>-->
            <?php foreach ($ob as $keyObj => $valObj) {
//                Yii::warning($ob, '$ob2');
                ?>
                <div class="col" style="font-size:24px;border-bottom: 4px solid silver; background: #999795; height: 40px; color:#333">
                    <b><?php echo $keyObj ?></b>
                </div>
                <div class="row mb-1">
                    <?php
                    foreach ($valObj as $keyPl => $valPl) {
//                        Yii::warning($valObj, '$valObj###');
//                        Yii::warning($valPl, '$valPl###');
                        foreach ($valPl as $keyDat => $valDat) {
//                            Yii::warning($valDat, '$valDat----!!');
                            ?>
                            <div class="col">
                                <div class="col" style="font-size:20px">





<!--                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">-->
<!--                                            Ссылка с href-->
<!--                                        </a>-->
                                        <button type="button" data-toggle="collapse" data-target="#aa<?php echo $valDat['datchId']?>" >
                                            <?php echo $keyDat ?>
                                        </button>

                                    <div class="collapse" id="aa<?php echo $valDat['datchId']?>">
                                        <div class="card card-body">
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress2">Address 2</label>
                                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity">City</label>
                                                        <input type="text" class="form-control" id="inputCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected>Choose...</option>
                                                            <option>...</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="inputZip">Zip</label>
                                                        <input type="text" class="form-control" id="inputZip">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                                        <label class="form-check-label" for="gridCheck">
                                                            Check me out
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </form>
                                        </div>
                                    </div>





<!--                                    <a href="https://apinjener.ru/setup/param?datchId=--><?php //echo $valDat['datchId']?><!--">--><?php //echo $keyDat ?><!--</a>-->
                                </div>
                            </div>
                            <?php
                            //$s = ArrayHelper::getValue($array, $key);
                            //foreach ($valDat as $keyPok => $valPok) {
                            //Yii::warning($valPok, '$valPok----!!');
                            ?>
                            <div class = "col">
                                <div class = "col" style = "font-size:20px; text-align: right">
                                    <?php //echo $valDat['value']  ?>
                                    <i style="color: red"><?php echo $valDat['value'] ?></i>
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
