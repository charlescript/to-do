<?php
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('color')->default('#FFFFFF');
            $table->foreignIdFor(User::class)->references('id')->on('users')->onDelete('CASCADE'); //Referenciando ao id da tabela usuarios
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
        Schema::table('categories', function(Blueprint $table){
            $table->dropForeignIdFor(User::class);
        }); // Caso queira fazer uma deleção o código acima deleta a chave estrangeira e depois deleta a tabela
        Schema::dropIfExists('categories');
    }
};
