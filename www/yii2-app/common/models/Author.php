<?php

namespace common\models;

use DateTime;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property int $id
 * @property string $fio
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Book[] $books
 */
class Author extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'author';
    }

    public function rules(): array
    {
        return [
            [['fio'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['fio'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлён',
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable('book_author', ['author_id' => 'id']);
    }
}
