<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Personal chat') }} {{$user->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div id="app">
                            <div id="user-id-chat" data-id="{{$user->id}}"></div>
                            <chat-message-ls  :user="{{ auth()->user() }}"></chat-message-ls>
                            <chat-form-ls></chat-form-ls>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        function ready() {
            setTimeout(function (){
                document.querySelector('#scroll-down').scrollTo(0, document.querySelector('#scroll-down').scrollHeight);
            },1000)
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
</x-app-layout>
