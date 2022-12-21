<?php
/**
 * Created by PhpStorm.
 * User: szabics
 * Date: 2022. 12. 20.
 * Time: 19:52
 */

namespace app\modules\v1\models;

use Yii;
use app\models\ModelConverter;

class SecretResponse
{
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_NOT_FOUND = 404;
    const STATUS_CODE_INVALID_INPUT = 405;

    const STATUS_CODE_OK_TEXT = "OK";
    const STATUS_CODE_BAD_REQUEST_TEXT = "Bad Request";
    const STATUS_CODE_NOT_FOUND_TEXT = "Secret not fount";
    const STATUS_CODE_INVALID_INPUT_TEXT = "Invalid input";

    const RESPONSE_TYPE_JSON = "application/json";
    const RESPONSE_TYPE_XML = "application/xml";

    private static $responseFormatsArray = [
        self::RESPONSE_TYPE_JSON => 'json',
        self::RESPONSE_TYPE_XML => 'xml'
    ];

    /**
     * Response a Secret model in choosen content type.
     *
     * @param $acceptHeader
     * @param $model
     * @return string|array
     */
    public static function modelResponse($model, $acceptHeader = "application/json") {
        switch ($acceptHeader) {
            case self::RESPONSE_TYPE_JSON: {
                Yii::$app->response->format = "json";
                $returnContent = ModelConverter::convertModelToAttributesArray($model);
                break;
            }
            case self::RESPONSE_TYPE_XML: {
                Yii::$app->response->format = "xml";
                $returnContent = ModelConverter::convertModelAttributesToXml($model);
                break;
            }
            default: {
                return self::errorResponseByType($acceptHeader, self::STATUS_CODE_BAD_REQUEST, self::STATUS_CODE_BAD_REQUEST_TEXT);
                break;
            }
        }

        return $returnContent;
    }

    private static function response($responseType, $statusCode, $statusText) {
        Yii::$app->response->statusCode = $statusCode;
        Yii::$app->response->format = $responseType;
        return [
            "code" => $statusCode,
            "description" => $statusText
        ];
    }

    public static function errorResponseByType($responseType, $statusCode, $statusText) {
        $returnResponseType = key_exists($responseType, self::$responseFormatsArray) ? self::$responseFormatsArray[$responseType] : self::$responseFormatsArray[self::RESPONSE_TYPE_JSON];
        return self::response($returnResponseType, $statusCode, $statusText);
    }
}