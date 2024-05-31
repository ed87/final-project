<?php

use App\Models\Internship;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('internship_id')->nullable()->unsigned();
            $table->foreign('internship_id')->references('id')->on('internships')->onDelete('cascade');

            $table->bigInteger('university_id')->nullable()->unsigned();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');

            $table->bigInteger('company_id')->nullable()->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            
            $table->string('internship_letter');
            
            $table->string('status')->default(Internship::STATUS_PENDING);

            $table->timestamps();

            $table->unique(['internship_id', 'university_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_applications');
    }
}
