<x-app-layout>
      <div class="py-12">
          <div class="max-w-9/12 mx-auto sm:px-6 lg:px-8 w-full">
              <div class="bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-8">
                  <!-- Gestão de Palavras-chave -->
                  
                  <livewire:keyword-manager />     

                  <!-- Prompt da IA do Chat -->
                  <livewire:chat-prompt />   
              </div>
          </div>
      </div>
  </x-app-layout>
  