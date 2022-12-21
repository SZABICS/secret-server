<?php
/**
 * Created by PhpStorm.
 * User: szabics
 * Date: 2022. 12. 21.
 * Time: 16:06
 */

namespace tests\unit\modules\v1\models;

use app\modules\v1\models\Secret;

class SecretTest extends \Codeception\Test\Unit
{

    /**
     * Search with empty hash value must return empty value.
     */
    public function testFindSecretByEmptyHash()
    {
        verify($secret = Secret::getSecretByHash(""))->empty();
    }

    /**
     * Test if we get back a valid Secret model, not a null empty value.
     */
    public function testMakeModelFromValidDataGivesBackValidModel() {
        verify($secret = Secret::makeModelFromPostData([
            "secret" => "testSecret",
            "expireAfterViews" => 10,
            "expireAfter" => 5
        ]))->notEmpty();
    }

    /**
     * expireAfterViews must be higher than zero.
     */
    public function testMakeModelFromWrongDataGivesBackInvalidEmptyModel() {
        verify($secret = Secret::makeModelFromPostData([
            "secret" => "testSecret",
            "expireAfterViews" => 0,
            "expireAfter" => 5
        ]))->empty();
    }

    /**
     * All test.
     * Make model from "post" data.
     * Add to the database.
     * Get the secret by its hash.
     * Delete the record.
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function testFindSecretByHashValidThenDelete()
    {
        verify($secret = Secret::makeModelFromPostData([
            "secret" => "testSecret",
            "expireAfterViews" => 10,
            "expireAfter" => 5
        ]))->notEmpty();
        verify($secret = Secret::addSecret($secret))->notEmpty();
        verify($secret = Secret::getSecretByHash($secret->hash))->notEmpty();

        if(!empty($secret)) {
            $secret->delete();
        }
    }
}