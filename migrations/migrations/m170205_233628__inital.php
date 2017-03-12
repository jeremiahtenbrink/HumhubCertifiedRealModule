<?php

use yii\db\Migration;
use yii\db\Schema;
use yii\db\ActiveRelationTrait;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\GroupPermission;
use humhub\modules\certified\libs\CertifiedHelper;



class m170205_233628__inital extends Migration
{
    public function up()
    {

        $this->addColumn('profile', 'certified', 'boolean' );
        $this->addColumn('profile', 'certified_by', 'int(11)' );

        $this->createTable('awaiting_certification',[
            'id' =>  Schema::TYPE_PK . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . '(11) UNIQUE',
            'created_at' =>  Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'her_picture_guid' =>  Schema::TYPE_STRING . ' UNIQUE',
            'his_picture_guid' => Schema::TYPE_STRING . ' UNIQUE',
            'status' => Schema::TYPE_STRING,
            'message' => Schema::TYPE_TEXT,
            'uncertified_group_id' => Schema::TYPE_SMALLINT,
            'certified_group_id' => Schema::TYPE_SMALLINT,
        ]);
        $this->addForeignKey('User ID', 'awaiting_certification', 'user_id', 'user', 'id');

        $this->addForeignKey('Her Picture', 'awaiting_certification','her_picture_guid', 'file','guid');
        $this->addForeignKey('His Picture', 'awaiting_certification','his_picture_guid', 'file','guid');

        $this->insert('setting', ['name' => 'Uncertified Users', 'value' => 'Uncertified Users', 'module_id' => 'certified']);

        $this->insert('setting', ['name' => 'Certified Users', 'value' => 'Certified Users', 'module_id' => 'certified']);

        $certifiedHelper = new CertifiedHelper();
        $certifiedHelper->checkGroups();

        $permissionID = 'humhub\modules\mail\permissions\SendMail';

        $certifiedHelper->checkGroupPermissions();

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
