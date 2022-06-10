<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"  />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100 g-sidenav-show  bg-gray-200">
<?php $this->beginBody() ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?= app\widgets\Navbar::widget() ?>
        </div>
    </div>
    <div class="row" id="MainContent">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <?= $content ?>
        </div>
        <div class="col-md-6 text-dark">
            <div class="RegistrationRightCard d-flex justify-content-end">
                <div>
                    <div class="gerb"><img src="../img/gerb.png" alt=""></div>
                    <div class="lock"><img src="../img/lock-screen1.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
