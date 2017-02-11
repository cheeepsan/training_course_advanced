<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

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
    <script src="https://use.fontawesome.com/77fe9189cf.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
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
                'label' => 'Calendar',
                'url' => ['/calendar/index']
              ],
              [
                'label' => 'New user',
                'url' => ['/user/new-user']
              ],
              [
                'label' => 'List users',
                'url' => ['/user/list-users']
              ],
              [
                'label' => 'Courses',
              //  'url' => ['/site/list-courses'],
                  'items' => [
                    [
                      'label' => 'New course',
                      'url' => ['/course/new-course'],
                    ],
                    [
                      'label' => 'List courses',
                      'url' => ['/course/list-courses'],
                    ]
                  ],
            ],
            [
              'label' => 'News',
            //  'url' => ['/site/list-courses'],
                'items' => [
                  [
                    'label' => 'New article',
                    'url' => ['/news/new-article'],
                  ],
                  [
                    'label' => 'List news',
                    'url' => ['/news/list-news'],
                  ]
                ],
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
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <?php Breadcrumbs::widget([
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
