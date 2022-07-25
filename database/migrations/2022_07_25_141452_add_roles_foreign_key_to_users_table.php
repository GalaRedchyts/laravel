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
        // проверка наличия таблицы
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // добавление колонки в таблицу и указание после какой колонки она будет
                if (!Schema::hasColumn('users', 'role_id')) {
                    $table->foreignId('role_id')->after('id')->constrained('roles');
                }
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // проверяем есть ли данная колонка и удаляем ее
                if (Schema::hasColumn('users', 'role_id')) {
                    $table->dropConstrainedForeignId('role_id');
                }
            });
        }
    }
};
