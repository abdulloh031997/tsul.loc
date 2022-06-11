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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
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
        <div class="col-md-12">
            <?php
            $flash = Yii::$app->session->getAllFlashes();
            if (!empty($flash)):
                foreach ($flash as $type => $message) :
                    $js = <<< JS
                                 Toastify({text: "{$message}",node: "{$type}"}).showToast();
JS;
                    $this->registerJs($js, \yii\web\View::POS_LOAD);
                endforeach;
            endif; ?>
        </div>
        <div class="col-md-12 my-5">
            <div class="row">
                <div class="col-12 ">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-5" id="NavBar">
                        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                                <?php
                                echo Breadcrumbs::widget([
                                    'options' => ['class' => 'breadcrumb'],
                                    'homeLink' => [
                                        'label' => "<li><i class='fa fa-home'></i> &nbsp;</li>\n",
                                        'url' => Yii::$app->homeUrl,
                                        'encode' => false,
                                    ],
                                    'itemTemplate' => "<li class='breadcrumb-item '> {link} </li>\n",
                                    'activeItemTemplate' => "<li class='breadcrumb-item active' aria-current='page'> {link} </li>\n",
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                                ?>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row" id="MainContentDashbord">
            <div class="col-md-3">
                <div class="nav card flex-column nav-tabs text-center"
                     id="v-tabs-tab">
                    <a class="nav-link <?= Yii::$app->request->url == '/person/index' ? 'active' : '' ?>
                                            <?= Yii::$app->request->url == '/person/index' ? 'active' : '' ?>"
                       id="v-tabs-home-tab"
                       href="/person/index">Mening arizalarim</a>
                    <a class="nav-link <?= Yii::$app->request->url == '/person/create' ? 'active' : '' ?>
                                            <?= Yii::$app->request->url == '/person/create' ? 'active' : '' ?>"
                       id="v-tabs-profile-tab"
                       href="/person/create">Shaxsiy ma'lumotlar</a>
                    <a class="nav-link <?= Yii::$app->request->url == '/person/address' ? 'active' : '' ?>
                                            <?= Yii::$app->request->url == '/person/address' ? 'active' : '' ?>"
                       id="v-tabs-profile-tab"
                       href="/person/address">Doimiy yashash manzili</a>
                    <a class="nav-link <?= Yii::$app->request->url == '/person/old-edu' ? 'active' : '' ?>
                                            <?= Yii::$app->request->url == '/person/old-edu' ? 'active' : '' ?>"
                       id="v-tabs-profile-tab"
                       href="/person/old-edu">Tugatgan ta'lim muassasasi
                    </a>
                    <a class="nav-link <?= Yii::$app->request->url == '/person/abitur' ? 'active' : '' ?>
                                       <?= Yii::$app->request->url == '/person/abitur' ? 'active' : '' ?>"
                       id="v-tabs-messages-tab"
                       href="/person/abitur">ARIZANI TAXRIRLASH</a>
                </div>
            </div>
            <div class="col-md-9">
                <?= $content ?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
<?php $this->endPage() ?>
