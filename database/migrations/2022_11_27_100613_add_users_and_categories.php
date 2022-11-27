<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddUsersAndCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $administratorCategory = new Category();
        $administratorCategory->title = Category::ADMINISTRATOR_CATEGORY_TITLE;
        $administratorCategory->save();

        $administrator = new User();
        $administrator->name = env('ADMINISTRATOR_NAME', 'Admin');
        $administrator->email = env('ADMINISTRATOR_EMAIL', 'admin@administrator.com');
        $administrator->password = Hash::make(env('ADMINISTRATOR_PASSWORD', 'asd123qwe'));
        $administrator->category()->associate($administratorCategory);
        $administrator->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $adminEmail = env('ADMINISTRATOR_EMAIL', 'admin@administrator.com');
        if ($administrator = User::where($adminEmail)->first()) {
            $administrator->delete();
        }

        $adminCategory = Category::where('title', Category::ADMINISTRATOR_CATEGORY_TITLE)->first();
        $adminCategory->delete();
    }
}
