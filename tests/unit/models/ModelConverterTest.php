<?php
/**
 * Created by PhpStorm.
 * User: szabics
 * Date: 2022. 12. 21.
 * Time: 16:06
 */

namespace tests\unit\models;

use app\models\ModelConverter;
use app\modules\v1\models\Secret;

class ModelConverterTest extends \Codeception\Test\Unit
{

    /**
     * Test the Converter method returns an array by the model attributes.
     */
    public function testModelConverterWithModel()
    {
        verify($attributesArray = ModelConverter::convertModelAttributesToXml(new Secret()))->notEmpty();
    }
}