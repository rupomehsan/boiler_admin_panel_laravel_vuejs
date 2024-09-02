<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path="App\Modules\BlogManagement\Blog\create_blogs_table.php"
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('tags')->nullable();
            $table->date('publish_date')->nullable();
            $table->string('writer')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->json('image')->nullable();
            $table->string('blog_type')->nullable();
            $table->string('url')->nullable();
            $table->string('slug', 250)->nullable();
            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('privecy_status')->default('public');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('blog_post_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_id')->nullable();
            $table->bigInteger('blog_category_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
    }
};
