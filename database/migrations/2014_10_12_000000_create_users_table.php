<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->string('gender');
            $table->string('imageLink');
            $table->string('userType');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // $users = Array
        // (
        //     Array('id' => '1','name' => 'rafat','email' => 'all@gmail.com','password' => 'asd123'),
        //     Array('id' => '2','name' => 'mehedi','email' => 'rap@gmail.com','password' => 'asd123')
            
        // );
       
        // foreach ($users as $value) {
        //     $row = new User;
        //     $row->id = $value['id'];
        //     $row->name = $value['name'];
        //     $row->email = $value['email'];
        //     $row->password = bcrypt($value['password']);
        //     // $row->type = $value['type'];
        //     // $row->company = $value['company'];
        //     $row->save();
        //     };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
