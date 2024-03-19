<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('users', function (Blueprint $table) {
        //権限を作成するためにroleカラムを追加。デフォルトは0(一般ユーザ用)とする。
            $table->tinyInteger('role')->default(0)->after('password');
        //店舗代表者用に店舗を割り当てるための外部キーカラムを追加。shop_idと紐付け。
            $table->Integer('owner_shop_id')->unsigned()->after('role')->nullable();
            $table->foreign('owner_shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('owner_shop_id');
        });
    }
}
