<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained();
            $table->string('uuid');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

            // Company is active [Y - Ativo, N - Inativo] - Se 'N' (inativo) ele perde o acesso ao sistema
            $table->enum('is_active', ['Y', 'N'])->default('Y');

            // Subscription info
            $table->date('subscription')->nullable(); // Data que se inscreveu
            $table->date('expires_at')->nullable(); // Data que expira o acesso
            $table->string('subscription_id', 255)->nullable(); // Identificador do Gateway de pagamento
            $table->boolean('subscription_active')->default(false); // Assinatura ativa
            $table->boolean('subscription_suspended')->default(false); // Assinatura cancelada
            $table->date('subscription_suspended_at')->nullable(); // Data de cancelamento da assinatura

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
