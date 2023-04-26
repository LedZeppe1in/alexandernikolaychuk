<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use app\widgets\Alert;
use app\assets\AppAsset;
use app\components\widgets\WLang;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/57d69475c9.js" crossorigin="anonymous"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto'],
            'encodeLabels' => false,
            'items' => [
                ['label' => Yii::t('app', 'NAV_ADMIN_ACCOUNT'),
                    'items' => [
                        ['label' => Yii::t('app', 'NAV_ADMIN_MY_PROFILE'),
                            'url' => ['/admin/user/profile']],
                        ['label' => Yii::t('app', 'NAV_ADMIN_MY_BIOGRAPHY'),
                            'url' => ['/admin/user/biography']],
                        ['label' => Yii::t('app', 'NAV_ADMIN_SIGN_OUT'),
                            'url' => ['/client/default/sing-out'], 'linkOptions' => ['data-method' => 'post']],
                    ]
                ],
                ['label' => Yii::t('app', 'NAV_ADMIN_MEDIA'),
                    'items' => [
                        ['label' => Yii::t('app', 'NAV_ADMIN_PHOTO'), 'url' => ['/admin/photo/list']],
                        ['label' => Yii::t('app', 'NAV_ADMIN_VIDEO'), 'url' => ['/admin/video/list']]
                    ]
                ],
                ['label' => Yii::t('app', 'NAV_ADMIN_CONCERTS'), 'url' => ['/admin/concert/list']],
                ['label' => Yii::t('app', 'NAV_ADMIN_MUSIC'), 'url' => ['/admin/music/list']],
                ['label' => Yii::t('app', 'NAV_ADMIN_PROJECTS'), 'url' => ['/admin/project/list']],
                ['label' => Yii::t('app', 'NAV_ADMIN_REPERTOIRE'), 'url' => ['/admin/repertoire/list']]
            ],
        ]);

        echo "<form class='navbar-form'>" . WLang::widget() . "</form>";

        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => [
                    'class' => 'px-4 bg-light rounded',
                ],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer id="footer" class="mt-auto py-4 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; <?= date('Y') ?>
                    <?= Yii::t('app', 'FOOTER_LOGO') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::t('app', 'FOOTER_POWERED_BY') .
                    ' <a href="https://github.com/LedZeppe1in">' . Yii::t('app', 'FOOTER_DEVELOPER') .
                    '</a>' ?></div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>