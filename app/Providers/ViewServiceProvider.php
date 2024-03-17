<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Message; // Inclua o uso do modelo Message

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('components.chat', function ($view) {
            // Buscar todas as mensagens, por exemplo
            $messages = Message::all(); // Adapte conforme necessário, talvez você queira limitar ou filtrar isso

            // Passando o usuário autenticado e as mensagens para a view
            $view->with([
                'messages' => $messages,
            ]);
        });
    }
}
