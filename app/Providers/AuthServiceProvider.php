<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Categoria' => 'App\Policies\CategoriaPolicy',
        'App\Marca' => 'App\Policies\MarcaPolicy',
        'App\Produto' => 'App\Policies\ProdutoPolicy',
        'App\Promocao' => 'App\Policies\PromocaoPolicy',
        'App\Pedido' => 'App\Policies\PedidoPolicy',
        'App\Estoque' => 'App\Policies\EstoquePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Chat'=>'App\Policies\ChatPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
