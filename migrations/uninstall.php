<?php
use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        $this->dropTable('awaiting_certification');
        $this->dropColumn('profile', 'awaiting_certification');
        $this->dropColumn('profile', 'certified');
        $this->dropColumn('profile', 'certified_by');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }
}