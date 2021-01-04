<?php

use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->text('description')->nullable();
            $table->enum('priority', TaskPriority::all())->default(TaskPriority::NORMAL);
            $table->enum('status', TaskStatus::all())->default(TaskStatus::NOT_STARTED);
            $table->date('due_date')->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'slug']);

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });

        Schema::dropIfExists('tasks');
    }
}
