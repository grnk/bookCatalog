<?php

namespace common\models;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $book_id
 * @property int $author_id
 * @property string|null $created_at
 *
 * @property Author $author
 * @property Book $book
 */
class BookAuthor extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => (new DateTime('now'))->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'book_author';
    }

    public function rules(): array
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
            [['created_at'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
        ];
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }
}
