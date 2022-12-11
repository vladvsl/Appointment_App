<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_7735736')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_7735736')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
