<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_list', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('key');
            $table-> text('description')->nullable();
            $table->timestamps();
        });

        DB::table('permission_list')->insert([
            [
                'category' => 'Usermanagement', 
                'name'     => 'Can Manage Users',
                'key'      => 'can_manage_user', 
                'description'=> 'User can create, update and view other users'  
            ], 
            [
                'category' => 'Usermanagement', 
                'name'     => 'Can View Users',
                'key'      => 'can_view_user', 
                'description'=> 'User can view other users'  
            ], 
            [
                'category' => 'Usermanagement', 
                'name'     => 'Can Delete Users',
                'key'      => 'can_delete_user', 
                'description'=> 'User can delete user, (Manage permission is needed)'   
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
    }
}
