<?php

namespace common\models;

use DateTime;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property string $year_of_publication
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $main_page_photo
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Author[] $authors
 */
class Book extends ActiveRecord
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
        return 'book';
    }

    public function rules(): array
    {
        return [
            [['title', 'year_of_publication'], 'required'],
            [['year_of_publication', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['title', 'isbn', 'main_page_photo'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'year_of_publication' => 'Год публикации',
            'description' => 'Описание',
            'isbn' => 'isbn',
            'main_page_photo' => 'Фото главной страницы',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }
}
