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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('gstin', 25)->after('mobile')->nullable();
            $table->string('re_pd', 8)->after('gstin')->default('0.00')->nullable();
            $table->string('re_fh', 8)->after('re_pd')->default('0.00')->nullable();
            $table->string('re_prism', 8)->after('re_fh')->default('0.00')->nullable();
            $table->string('le_pd', 8)->after('re_prism')->default('0.00')->nullable();
            $table->string('le_fh', 8)->after('le_pd')->default('0.00')->nullable();
            $table->string('le_prism', 8)->after('le_fh')->default('0.00')->nullable();
            $table->string('vd', 8)->after('le_prism')->default('0.00')->nullable();
            $table->string('ipd', 8)->after('vd')->default('0.00')->nullable();
            $table->string('npd', 8)->after('ipd')->default('0.00')->nullable();
            $table->string('dbl', 8)->after('npd')->default('0')->nullable();
            $table->string('ed', 8)->after('dbl')->default('0')->nullable();
            $table->string('size_a', 8)->after('ed')->default('0')->nullable();
            $table->string('size_b', 8)->after('size_a')->default('0')->nullable();
            $table->string('pa', 8)->after('size_b')->default('0')->nullable();
            $table->string('wa', 8)->after('pa')->default('0')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['gstin', 're_pd', 're_fh', 're_prism', 'le_pd', 'le_fh', 'le_prism', 'vd', 'ipd', 'npd', 'dbl', 'ed', 'size_a', 'size_b', 'pa', 'wa']);
        });
    }
};
