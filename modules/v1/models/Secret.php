<?php

namespace app\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "secret".
 *
 * @property int $id
 * @property string $hash
 * @property string $secretText
 * @property string $createdAt
 * @property string|null $expiresAt
 * @property int|null $remainingViews
 */
class Secret extends \yii\db\ActiveRecord
{
    const MIN_REMAINING_TIME = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'secret';
    }

    /**
     * {@inheritdoc}
     * Rules for the Secret record.
     * These rules describes some validation for the properties.
     * @return array
     */
    public function rules()
    {
        return [
            [['hash', 'secretText', 'createdAt', 'remainingViews'], 'required'],
            [['secretText'], 'string'],
            [['createdAt', 'expiresAt'], 'safe'],
            [['remainingViews'], 'integer'],
            [['hash'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'secretText' => 'Secret Text',
            'createdAt' => 'Created At',
            'expiresAt' => 'Expires At',
            'remainingViews' => 'Remaining Views',
        ];
    }

    /**
     * This code run when we find the model from the database.
     * We decrease the remainingViews property then update the record.
     * We will show 0 remainings at the last possible select.
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->remainingViews--;
        $this->update(false);
    }

    /**
     * Return a Secret model from database by the given hash string.
     * If the hash is empty or not found on the database, then it will return null.
     * Conditions:
     * hash must be match.
     * remainingViews must higher than MIN_REMAINING_TIME const.
     * expiresAt must be empty or higher than actual time.
     * @param string $hash
     * @return ActiveRecord|null
     */
    public static function getSecretByHash($hash) {
        if(empty($hash)) return null;
        $model = self::find()
                ->where(["hash" => $hash])
                ->andWhere([">=", "remainingViews", self::MIN_REMAINING_TIME])
                ->andWhere(["OR",
                        ["expiresAt" => null],
                        [">=", "expiresAt", date("Y-m-d H:i:s")]
                ])
                ->one();
        return !empty($model) ? $model : null;
    }

    /**
     * Insert the given Secret model to the database.
     * The save() method does some validation too, so if it will give back fasle, then the model is not stored.
     * Returns the model on success, and false when there are any data validation problem.
     * @param Secret $secretModel
     * @return ActiveRecord|null
     */
    public static function addSecret($secretModel) {
        if(!empty($secretModel)) {
            if($secretModel->save()) {
                return $secretModel;
            }
        }
        return null;
    }


    /**
     * Make a Secret model from the given $postData property.
     * We go trough on some property validation.
     * The 'expireAfterViews' value must be higher than zero.
     * If there are any problem with datas, the method returns a null value.
     * @param $postData
     * @return Secret|null
     */
    public static function makeModelFromPostData($postData) {
        $secretText = isset($postData["secret"]) ? $postData["secret"] : "";
        $expireAfterViews = isset($postData["expireAfterViews"]) ? $postData["expireAfterViews"] : "";
        $expireAfter  = isset($postData["expireAfter"]) ? $postData["expireAfter"] : "";

        if(intval($expireAfterViews) > 0) {
            $model = new self();
            $model->hash = hash("sha256", time());
            $model->remainingViews = $expireAfterViews;
            $model->secretText = $secretText;
            $model->createdAt = date("Y-m-d H:i:s");
            $model->calculateExpireAtByMinutes($model->createdAt, $expireAfter);
            return $model;
        }
        return null;
    }

    /**
     * This method calculates the expire time of the secret.
     * It needs the time of creation (createTime) and the minutes to add.
     * If the minutes equal to zero, then the secret does not have expire time.
     * If the minutes higher than zero, plus the createTime with them.
     * @param $createTime
     * @param int $minutes
     */
    private function calculateExpireAtByMinutes($createTime, $minutes = 0) {
        if(empty($minutes)) {
            $this->expiresAt = "";
        }
        $this->expiresAt = date('Y-m-d H:i:s', strtotime($createTime." +".$minutes." minutes"));
    }

}
