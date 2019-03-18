<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaomodulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daomodule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->default('');
            $table->string('type', 10)->default('');
            $table->decimal('height', 8, 2)->default(0);
            $table->decimal('width', 8, 2)->default(0);
            $table->timestamp('createTime');
            $table->timestamp('updateTime');
            $table->smallInteger('isBan')->default(0);
            $table->string('remark', 200)->default('');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daomodule');
    }
}
