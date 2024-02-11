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
        Schema::create('profile_pemetaans', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            // $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("user_id");
            $table->string("nama_perumahan");
            $table->string("alamat_perumahan");
            $table->text("deskripsi");
            $table->string("luas_lahan");
            $table->string("longitude");
            $table->string("latitude");
            $table->string("izin_lingkungan_setempat");
            $table->string("rutr");
            $table->string("izin_pemanfaatan_tanah");
            $table->string("izin_prinsip");
            $table->string("izin_lokasi");
            $table->string("izin_badan_lingkungan_hidup");
            $table->string("izin_dampak_lalu_lintas");
            $table->enum("status",["pending","accepted","rejected"])->default("pending");
            $table->string("profile");
            $table->string("note")->nullable();
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
        Schema::dropIfExists('profile_pemetaans');
    }
};
