<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\web\UploadedFile;
use yii\behaviors\BlameableBehavior;
use app\models\query\ProductQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $created_by
 * @property string $name
 * @property string $content
 * @property integer $price
 * @property integer $quantity
 * @property string $imageFile
 *
 * @property User $owner
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by'], 'integer'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1000*2000],
            [['name', 'price'], 'required'],
            [['price'], 'number', 'min' => 0],
            [['quantity'], 'integer', 'min' => 1],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Owner',
            'name' => 'Name',
            'content' => 'Content',
            'imageFile' => 'Image',
            'price' => 'Price',
        ];
    }

    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     *
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        if(isset($this->imageFile)){
            $this->imageFile = UploadedFile::getInstance($this,'imageFile');
            if(is_object($this->imageFile)){
                $path = Yii::$app->basePath . '/web/images/';
                $this->imageFile->saveAs($path.$this->id."_".$this->imageFile);
                $this->imageFile = $this->id."_".$this->imageFile;
                Yii::$app->db->createCommand()
                    ->update('product', ['imageFile' => $this->imageFile], 'id = "'.$this->id.'"')
                    ->execute();
            }
        }
    }

    /**
     * @return void
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function buy()
    {
        $this->quantity -= 1;
        $this->update(false, ['quantity']);
            if ($this->quantity <= 0) {
                $this->delete();
            }
    }
}
