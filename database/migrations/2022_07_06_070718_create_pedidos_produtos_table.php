<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pedido;
use App\Models\FormaPagamento;
use App\Models\Produto;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produtos', function (Blueprint $table) {
           $table->foreignIdFor(Pedido::class);
           $table->foreignIdFor(Produto::class);
           $table->double('quantidade');
           $table->double('preco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_produtos');
    }
};
