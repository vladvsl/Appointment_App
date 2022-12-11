<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_7735731')->references('id')->on('clients');
            $table->unsignedBigInteger('employees_id')->nullable();
            $table->foreign('employees_id', 'employees_fk_7735732')->references('id')->on('employees');
        });
    }
}
