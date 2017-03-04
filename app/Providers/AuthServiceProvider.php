<?php

namespace App\Providers;

use App\Categoria;
use App\Estoque;
use App\Marca;
use App\Pedido;
use App\Policies\CategoriaPolicy;
use App\Policies\EstoquePolicy;
use App\Policies\MarcaPolicy;
use App\Policies\PedidoPolicy;
use App\Policies\ProdutoPolicy;
use App\Policies\PromocaoPolicy;
use App\Policies\UserPolicy;
use App\Produto;
use App\Promocao;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Categoria::class => CategoriaPolicy::class,
        Marca::class => MarcaPolicy::class,
        Produto::class => ProdutoPolicy::class,
        Promocao::class => PromocaoPolicy::class,
        Pedido::class => PedidoPolicy::class,
        Estoque::class => EstoquePolicy::class,
        User::class => UserPolicy::class
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
