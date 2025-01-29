<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable(false);
            $table->unsignedBigInteger('penalty_id')->nullable();
            $table->string('no_car')->nullable(false);
            $table->date('date_borrow')->nullable(false);
            $table->date('date_return')->nullable();
            $table->decimal('down_payment', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('tenant_id')->on('tenants')->references('id');
            $table->foreign('penalty_id')->on('penalties')->references('id');
        });

        // Schema::create('return_rents', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('tenant_id')->nullable(false);
        //     $table->unsignedBigInteger('rent_id')->nullable(false);
        //     $table->unsignedBigInteger('penalty_id')->nullable(false);

        //     $table->string('created_by');
        //     $table->string('updated_by');
        //     $table->timestamps();

        //     $table->foreign('tenant_id')->on('tenants')->references('id');
        //     $table->foreign('rent_id')->on('rents')->references('id');
        //     $table->foreign('penalty_id')->on('penalties')->references('id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_rents');
    }
};
