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
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable(); // أو بدون nullable إذا كان إجباري
            // إن أردت إضافة علاقة خارجية:
            // $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // $table->dropForeign(['courses_id']); // إذا أضفت foreign key
            $table->dropColumn('course_id');
        });
    }

};
