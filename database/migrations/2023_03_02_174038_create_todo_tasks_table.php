<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->string('is_complete')->default(0);
            $table->string('duration');
            $table->unsignedBigInteger('todolist_id');
 
            $table->foreign('todolist_id')->references('id')->on('todo_lists')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_tasks');
    }
}
