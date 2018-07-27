<?php

use Phpmig\Migration\Migration;

class AddPlayer extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $container = $this->getContainer();
        $db = $container['db'];
        $db->execute(
            "CREATE TABLE `player` (\n".
            "  `player_id` int(11) unsigned NOT NULL,\n".
            "  KEY `player_id` (`player_id`)\n".
            ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='プレイヤーデータ';\n"
        );
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $container = $this->getContainer();
        $db = $container['db'];
        $db->execute(
            "DROP TABLE `player`;"
        );
    }
}
