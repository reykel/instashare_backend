<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 255);
            $table->string('precio', 15);
            $table->string('um', 5);
            $table->foreignId('categoria_id')
                  ->nullable()
                  ->constrained('categorias')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('organization_id')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
