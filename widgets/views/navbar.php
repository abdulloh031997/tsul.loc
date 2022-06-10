<nav class="navbar navbar-expand-lg navbar-light bg-light mt-3">
    <div class="container-fluid">
        <button class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation" >
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mt-2 mt-lg-0" href="/">
                <img src="/img/logoone.jpg" alt="Logo">
            </a>
        </div>
        <div class="d-flex align-items-center">
            <?php if (Yii::$app->user->isGuest): ?>
                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-round btn-sm mb-0 btn-outline-primary me-2" href="/site/login">KIRISH</a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a href="/site/register"
                       class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">RO'YXATDAN O'TISH</a>
                </li>
            <?php else: ?>
                <ul class="navbar-nav flex-row">
                    <li class="nav-item me-3 me-lg-1">
                        <a class="nav-link d-sm-flex align-items-sm-center " href="#">
                            <img
                                    src="https://mdbcdn.b-cdn.net/img/new/avatars/1.webp"
                                    class="rounded-circle"
                                    height="22"
                                    alt="Black and White Portrait of a Man"
                                    loading="lazy"
                            />
                            <strong class="d-none d-sm-block ms-1">John</strong>
                        </a>
                    </li>

                </ul>
                    <?= \yii\helpers\Html::a('<i class="fa fa-sign-out"></i>', ['/site/logout'], ['class' => 'btn btn-outline-primary btn-rounded', 'data' => ['method' => 'post']]) ?>
                </li>
            <?php endif ?>
        </div>
    </div>
</nav>
