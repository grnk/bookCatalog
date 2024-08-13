<?php

use yii\db\Migration;

class m240810_092612_create_book_author_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('book_author', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_book_author_book_id',
            'book_author',
            'book_id',
            'book',
            'id',
            'RESTRICT'
        );

        $this->addForeignKey(
            'fk_book_author_author_id',
            'book_author',
            'author_id',
            'author',
            'id',
            'RESTRICT'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_book_author_book_id', 'book_author');
        $this->dropForeignKey('fk_book_author_author_id', 'book_author');
        $this->dropTable('book_author');
    }
}
