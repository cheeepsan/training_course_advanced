<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Lato" rel="stylesheet"> 
    <script src="https://use.fontawesome.com/77fe9189cf.js"></script>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
      echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => [
              [
                'label' => 'Home',
                'url' => ['/site/index']
              ],
              [
                'label' => 'News',
                'url' => ['/news/list-news'],
              ],
              [
                'label' => 'All assigments',
                'url' => ['/task/list-all-tasks'],
              ],

              Yii::$app->user->isGuest ? (
                  ['label' => 'Login', 'url' => ['/site/login']]
              ) : (
                  '<li>'
                  . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                  . Html::submitButton(
                      'Logout (' . Yii::$app->user->identity->username . ')',
                      ['class' => 'btn btn-link']
                  )
                  . Html::endForm()
                  . '</li>'
              )
          ],
      ]);
      NavBar::end();
  } else {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
              'label' => 'Home',
              'url' => ['/site/index']
            ],

            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
  }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
