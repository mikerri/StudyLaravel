<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     * : Create posts table
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id'); // Auto-Increment
            $table->string('subject');
            $table->string('content');
            $table->timestamps(); // 날짜 저장을 위한 updated_at, created_at Column 생성
        });
    }

    /**
     * Reverse the migrations.
     * : Drop posts table
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
