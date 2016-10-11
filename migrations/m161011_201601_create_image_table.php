<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m161011_201601_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'title' => $this->string(120)->notNull(),
            'htmlTitle' => $this->string(120),
            'link' => $this->string(200)->notNull(),
            'bytesSize' => $this->integer(),
            'thumbnailLink' => $this->string(300),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('image');
    }
}
