<?php

use yii\db\Migration;
use yii\db\Schema;


class m170205_233628__inital extends Migration
{
    public function up()
    {

        $this->addColumn('profile', 'awaiting_certification', 'boolean' );
        $this->addColumn('profile', 'certified', 'boolean' );
        $this->addColumn('profile', 'certified_by', 'int(11)' );

        $this->createTable('awaiting_certification',[
            'id' =>  Schema::TYPE_PK . ' NOT NULL',
            'created_at' =>  Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'his_picture_url' =>  Schema::TYPE_STRING,
            'her_picture_url' => Schema::TYPE_STRING,
        ]);


    }

    public function down()
    {
        echo "m170205_233628__inital cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
