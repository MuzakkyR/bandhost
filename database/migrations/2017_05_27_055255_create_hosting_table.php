<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('hostings', function(Blueprint $table) {
            $table->increments('id', 3);
            $table->string('hostingID', 5)->unique();
            $table->string('packet_name', 16);
            $table->integer('month_price');
            $table->integer('disk_space');
            $table->integer('bandwidth')->nullable();
            $table->integer('database')->nullable();
            $table->integer('email')->nullable();
            $table->integer('addon_domain')->nullable();
            $table->integer('parked_domain')->nullable();
            $table->integer('subdomain')->nullable();
            $table->text('other');
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
        Schema::dropIfExists('hostings');
    }
}
