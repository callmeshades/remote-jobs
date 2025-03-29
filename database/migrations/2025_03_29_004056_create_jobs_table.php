<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignIdFor(Employer::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->text('body');
            $table->string('url');
            $table->string('type')->default('Full Time'); // Job type such as Part Time, Full Time, Contract
            $table->string('pay_type')->nullable(); // Salary, Hourly
            $table->integer('minimum_pay');
            $table->integer('maximum_pay');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
