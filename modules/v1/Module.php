<?php

namespace app\modules\v1;

/**
 * Module init class for our Secret Server API V1 module.
 * This Module file must be set in config/web.php
 *
 * Class Module
 * @package app\modules\v1
 */
class Module extends \yii\base\Module
{
    /**
     * @var string $controllerNamespace The namespace of the controllers directory of Module.
     */
    public $controllerNamespace = 'app\modules\v1\controllers';

    /**
     * Module init method.
     */
    public function init()
    {
        parent::init();

    }
}
