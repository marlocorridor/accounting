<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccountsTableAddTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->enum('type', [
                    'assets',
                    'liabilities',
                    'equity',
                    'revenue',
                    'expenses',
                ])
                ->default('assets')
                ->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
