<?php

/* @var $current app\components\widgets\WLang */
/* @var $langs app\components\widgets\WLang */

use yii\bootstrap5\ButtonDropdown;

?>
<div id="lang">
    <?php foreach ($langs as $lang):?>
        <?= ButtonDropdown::widget([
            'label' => $current->url == 'ru' ? "<figure class='icon-lang icon-ru'></figure>" :
                "<figure class='icon-lang icon-en'></figure>",
            'options' => [
                'class' => 'btn-default lang-button',
            ],
            'encodeLabel' => false,
            'dropdown' => [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => $lang->url == 'ru' ? "<figure class='icon-lang icon-ru'></figure>" :
                            "<figure class='icon-lang icon-en'></figure>",
                        'url' => '/' . $lang->url . Yii::$app->getRequest()->getLangUrl()
                    ],
                ]
            ]
        ]); ?>
    <?php endforeach;?>
</div>