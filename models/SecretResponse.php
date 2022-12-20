<?php
/**
 * Created by PhpStorm.
 * User: szabi
 * Date: 2022. 12. 20.
 * Time: 19:52
 */

namespace app\models;

use Yii;

class SecretResponse
{
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_NOT_FOUND = 404;
    const STATUS_CODE_INVALID_INPUT = 405;

    const RESPONSE_TYPE_JSON = "application/json";
    const RESPONSE_TYPE_XML = "application/xml";

    /**
     * Response a Secret model in choosen content type.
     *
     * @param $acceptHeader
     * @param $model
     * @return string|array
     */
    public static function modelResponse($acceptHeader = "application/json", $model = "") {
        $returnStatusCode = self::STATUS_CODE_OK;
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
                return self::jsonResponse($returnStatusCode, "BadRequest");
                break;
            }
        }

        return $returnContent;
    }

    public static function errorResponseByType($responseType, $statusCode, $statusText) {
        switch ($responseType) {
            case self::RESPONSE_TYPE_JSON: return self::jsonResponse($statusCode, $statusText); break;
            case self::RESPONSE_TYPE_XML: return self::xmlResponse($statusCode, $statusText); break;
            default:  return self::jsonResponse(self::STATUS_CODE_NOT_FOUND, "NotFound"); break;
        }
    }

    private static function jsonResponse($statusCode, $statusText) {
        header($_SERVER["SERVER_PROTOCOL"], true, $statusCode);
        Yii::$app->response->format = "json";
        return [
            "code" => $statusCode,
            "description" => $statusText
        ];
    }

    private static function xmlResponse($statusCode, $statusText) {
        header($_SERVER["SERVER_PROTOCOL"], true, $statusCode);
        Yii::$app->response->format = "xml";
        return [
            "Error" => [
                "Code" => $statusCode,
                "Description" => $statusText
            ]
        ];
    }
}