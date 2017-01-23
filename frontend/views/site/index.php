<?php

$this->title = 'My Yii Application';
?>


        <div class="row">
            <div class="col-md-12">
                <h1>Message title</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                <div class="col-md-12">
                    <?= frontend\widgets\latestAssigment\LatestAssigmentWidget::widget(['course' => $course]); ?>
                </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                    <?= frontend\widgets\news\NewsWidget::widget(); ?>
                </div>
                </div>
            </div>
            <div class="col-md-8">
            <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
                  'events'=> $events,
              )); ?>
            </div>
        </div>
        </div>


