<?php

namespace app\controllers;

use app\models\ModelConverter;
use app\models\Secret;
use app\models\SecretGetResponse;
use app\models\SecretPostResponse;
use app\models\SecretResponse;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class V1Controller
 * API controller V1 version.
 * This API is a solution for store and show Secrets through POST and GET requests.
 * @package app\controllers
 */
class V1Controller extends Controller
{

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
     *
     */
    public function actionSecret() {
        if(Yii::$app->request->isPost) {
            if($model = Secret::addSecret(Secret::makeModelFromPostData(Yii::$app->request->post()))) {
                return SecretResponse::modelResponse($model, self::$acceptHeader);
            }
            return SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_INVALID_INPUT, SecretResponse::STATUS_CODE_INVALID_INPUT_TEXT);
        }
        SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_BAD_REQUEST, SecretResponse::STATUS_CODE_BAD_REQUEST_TEXT);
    }

    /**
     * Returns a Secret by the given Hash if its still available.
     * Available a Secret when:
     * Has enough remaining views
     * The expire date
     *
     * The URL must be set up in /config/web.php -> UrlManager section
     * The valid path:
     * v1 -> Controller, secret -> Action, hash will be the parameter to get.
     * 'v1/secret/<hash:([-a-zA-Z0-9_\-\@\.]*)>' => 'v1/get-secret-by-hash'
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
        SecretResponse::errorResponseByType(self::$acceptHeader, SecretResponse::STATUS_CODE_BAD_REQUEST, SecretResponse::STATUS_CODE_BAD_REQUEST_TEXT);
    }

}
