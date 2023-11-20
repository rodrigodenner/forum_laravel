<?php

use App\Enums\SupportStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supports', function (Blueprint $table) {
            // $table->id();   Cria um ID global usando UUID ao criar um novo modelo para trazer segurança
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();//criando relacionamento entre tabela user e supports
            $table->string('subject');
            $table->enum('status',array_column(SupportStatus::cases(),'name'));
            $table->text('body');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            // Estabelece uma relação: 'user_id' aqui faz referência a 'id' na tabela 'users'.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
