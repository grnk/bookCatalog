<?php

use yii\db\Migration;

class m240813_065500_add_user_table_columns_type_phone extends Migration
{

    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(30)->notNull()->after('email'));
        $this->addColumn('user', 'type', "ENUM('guest', 'user') NOT NULL DEFAULT 'guest' AFTER `phone`");

        $this->createIndex('phone', 'user', 'phone', true);

        return true;
    }

    public function safeDown()
    {
        $this->dropIndex('phone', 'user');

        $this->dropColumn('user', 'type');
        $this->dropColumn('user', 'phone');
    }
}
