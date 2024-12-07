<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('random_users', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // nama lengkap
        $table->string('email')->unique(); // email
        $table->string('gender'); // kategori: gender
        $table->string('job')->nullable(); // pekerjaan (jika diperlukan untuk kategori tambahan)
        $table->date('dob')->nullable(); // tanggal lahir
        $table->string('phone')->nullable(); // nomor telepon
        $table->timestamp('last_updated')->nullable(); // waktu terakhir di-update
        $table->boolean('is_edited')->default(false); // untuk data yang di-edit
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('random_users');
    }
};
