<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use app\modules\v1\models\Secret;
use app\modules\v1\models\SecretResponse;

/**
 * Class V1Controller
 * API controller V1 version.
 * This API is a solution to store and show Secrets through POST and GET requests.
 * @package app\controllers
 */
class SecretController extends Controller
{

    /**
     * @var string $acceptHeader Store the accept header from Header()
     */
    public static $acceptHeader;

    /**
     * It's not a solution!, but now for the example secret server
     * We set the 'enableCsrfValidation=false now to prevent 'BadRequestHttpException on POST.
     * This action will run before each action!
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        self::$acceptHeader = $_SERVER['HTTP_ACCEPT'];
        return parent::beforeAction($action);
    }

    /**
     * This method to send POST requests and store the new Secrets by the given values.
     * But first make some validation of the POST datas correctness.
     * The URL must be set up in /config/web.php -> UrlManager section
     * The valid path will:
     * 'v1/secret' => 'v1/secret/secret'
     * @return string|array
     */
    public function actionSecret() {
        if(Yii::$app->request->isPost) {
            if($model = Secret::addSecret(Secret::makeModelFromPostData(Yii::$app->request->post()))) {
                return SecretResponse::modelResponse($model, self::$acceptHeader);
            }
            return SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_INVALID_INPUT, SecretResponse::STATUS_CODE_INVALID_INPUT_TEXT);
        }
        return SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_BAD_REQUEST, SecretResponse::STATUS_CODE_BAD_REQUEST_TEXT);
    }

    /**
     * Returns a Secret by the given Hash if its still available.
     * Available a Secret when:
     * Has enough remaining views
     * The expire date
     *
     * The URL must be set up in /config/web.php -> UrlManager section
     * The valid path will:
     * 'v1/secret/<hash:([-a-zA-Z0-9_\-\@\.]*)>' => 'v1/secret/get-secret-by-hash'
     * @param $hash
     * @return string|array
     */
    public function actionGetSecretByHash($hash) {
        if(Yii::$app->request->isGet) {
            $model = Secret::getSecretByHash($hash);
            if(empty($model)) {
                return SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_NOT_FOUND, SecretResponse::STATUS_CODE_NOT_FOUND_TEXT);
            }
            return SecretResponse::modelResponse($model, self::$acceptHeader);
        }
        return SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_BAD_REQUEST, SecretResponse::STATUS_CODE_BAD_REQUEST_TEXT);
    }

}
