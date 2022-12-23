<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $patientCategory = new Category();
        $patientCategory->title = Category::PATIENT_CATEGORY_TITLE;
        $patientCategory->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $patientCategory = Category::where('title', Category::PATIENT_CATEGORY_TITLE)->first();
        $patientCategory->delete();
    }
}
