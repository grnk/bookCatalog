<?php

use yii\db\Migration;

class m240810_031852_create_book_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year_of_publication' => $this->date()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(),
            'main_page_photo' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

        $this->createIndex('book_title', 'book', 'title');
        $this->createIndex('book_date_of_publication', 'book', 'year_of_publication');
        $this->createIndex('book_isbn', 'book', 'isbn', true);
    }

    public function safeDown()
    {
        $this->dropTable('book');
    }
}
