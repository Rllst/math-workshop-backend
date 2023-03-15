<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Post
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->integer('views');
            $table->timestamp('date');
        });
        //Comment
        Schema::create('comments',function(Blueprint $table) {
            $table->id();

            $table->integer('post_id');
            $table -> string('email');
            $table -> string('name');
            $table -> string('content');
            $table->timestamp('date');
            $table->boolean('approved');
            $table->boolean('is_administrator');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

        });
        //Category
        Schema::create('categories',function(Blueprint $table) {
            $table->id();

            $table -> string('name')->unique();
            $table -> string('description')->nullable();
        });
        //Archive folder
        Schema::create('archive_folders', function(Blueprint $table) {
            $table->id();

            $table -> string('name')->unique();
            $table -> string('description');
        });
        //Archive file
        Schema::create('archive_files', function(Blueprint $table) {
            $table->id();

            $table->integer('archive_folder_id');
            $table -> string('name')->unique();
            $table -> timestamp('date');

            $table->foreign('archive_folder_id')->references('id')->on('archive_folders');
        });
         //Gallery Folder
         Schema::create('gallery_folders',function(Blueprint $table) {
            $table->id();

            $table -> date('date');
            $table -> string('name')->unique();
            $table -> string('description');
        });
        //Gallery Image
        Schema::create('gallery_images',function(Blueprint $table) {
            $table->id();

            $table->integer('gallery_folder_id');

            $table->foreign('gallery_folder_id')->references('id')->on('gallery_folders')->onDelete('cascade');
        });
        //Event
        Schema::create('events',function(Blueprint $table) {
            $table->id();

            $table -> timestamp('date');
            $table -> string('description');
            $table -> string('name');
        });
        //Team Member
        Schema::create('team_members',function(Blueprint $table) {
            $table->id();

            $table -> string('description');
            $table -> string('name');
        });
        //Quotes
        Schema::create('quotes',function(Blueprint $table) {
            $table->id();

            $table -> string('content');
            $table -> string('author');
        });
        //Category Post manytomany
        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('category_id');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropAllTables();
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('archive_folders');
        Schema::dropIfExists('archive_files');
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('gallery_folders');
        Schema::dropIfExists('events');
        Schema::dropIfExists('team_members');
    }
};
