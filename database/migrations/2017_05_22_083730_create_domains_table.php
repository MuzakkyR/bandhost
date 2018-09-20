<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function(Blueprint $table) {
            $table->increments('id', 3);
            $table->string('domainID', 5)->unique();
            $table->string('domain_name', 10);
            $table->integer('register_price');
            $table->integer('transfer_price');
            $table->integer('renewal_price');
            $table->string('brand', 20);
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
        Schema::dropIfExists('domains');
    }
}
