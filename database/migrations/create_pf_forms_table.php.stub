<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pf_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pf_wizard_id')->index();
            $table->foreign('pf_wizard_id')->references('id')
                ->on('pf_wizards')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('email');
            $table->string('name');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();
        });
    }
};
