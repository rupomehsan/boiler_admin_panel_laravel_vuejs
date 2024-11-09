<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\TestModuleOne\Database\create_test_module_ones_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_module_ones', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->integer('phone')->nullable();
            $table->enum('gender', ['male','female'])->nullable();
            $table->json('tags')->nullable();
            $table->float('price')->nullable();
            $table->tinyInteger('is_show')->default(0);
            $table->text('content')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_module_ones');
    }
};