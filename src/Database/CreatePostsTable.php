<?php namespace BtyBugHook\Membership\Database;


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static function up($tableName)
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('author_id');
            $table->string('title',100);
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('status',20)->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public static function down($tableName)
    {
        Schema::dropIfExists($tableName);
    }
}
