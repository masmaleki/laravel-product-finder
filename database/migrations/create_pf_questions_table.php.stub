<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pf_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pf_step_id')->index();
            $table->foreign('pf_step_id')->references('id')->on('pf_steps')
                ->onDelete('cascade');
            $table->unsignedBigInteger('pf_type_option_id')->index();
            $table->foreign('pf_type_option_id')->references('id')
                ->on('pf_type_options')->onDelete('cascade');
            $table->text('title');
            $table->jsonb('conditions')->nullable()->index();

            $table->longtext('desc')->nullable();
            $table->string('image')->nullable;
            $table->integer('point')->default(0);
            $table->boolean('is_required')->default(1);
            $table->string('status', 100)->default('active');
            $table->timestamps();
        });
    }
};
