<?php

use quangthinh\yii\generate\console\Migration;

class m171028_082947_init_route extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%route}}', [
            'id' => $this->string(36)->notNull(),
            'full_url' => $this->string(),
            'handle_class' => $this->string()->notNull(),
            'object_id' => $this->string(), // unique tương ứng với handle_class sẽ xử lý
            'route_name' => $this->string()->notNull(), // route name được ứng với route xử lý để parse controller / action
            'route_params' => $this->text()->notNull(), // json
            'priority' => $this->integer()->defaultValue(10),
        ]);
        $this->addPrimaryKey('pk_route', '{{%route}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%route}}');
    }
}
