<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pf_wizards', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->longtext('desc')->nullable();
            $table->string('status',100)->default('active');
            $table->timestamps();
        });
    }
};
