<?php
/**
 * Created by PhpStorm.
 * User: szabi
 * Date: 2022. 12. 20.
 * Time: 18:56
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class ModelConverter
 * @package app\models
 * A Model converter class.
 * This class can convert the incoming model or model attributes to a specific type.
 */
class ModelConverter
{

    /**
     * This method gives back a JSON data by the given model property.
     * @param Model $model
     * @return array
     */
    public static function convertModelToAttributesArray($model) {
        if(empty($model)) return [];
        return $model->attributes;
    }

    /**
     * This method gives back an XML data by the given model property.
     * It will make an XML string with the model attributes and the model Class root tag.
     * @param Model $model
     * @return array
     */
    public static function convertModelAttributesToXml($model) {
        if(empty($model)) return [];
        $xml = new \yii\web\XmlResponseFormatter;
        $classNameArray = explode("\\", $model::class);
        $rootTag = end($classNameArray);
        $xml->rootTag = "";

        Yii::$app->response->format = 'custom_xml';
        Yii::$app->response->formatters['custom_xml'] = $xml;

        $attributeReturnArray = [];
        foreach ($model->attributes as $attributeName => $attributeValue) {
            $attributeReturnArray[$rootTag][$attributeName] = $attributeValue;
        }
        return $attributeReturnArray;
    }
}