<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiosTable extends Migration
{
    public function up()
    {
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')->constrained()->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telpon', 20);
            $table->string('email');
            $table->string('nama_radio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('radios');
    }
}
