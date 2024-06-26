<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Conta de E-mail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded dark:bg-red-900 dark:text-red-200">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('email.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="imap_host" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Host IMAP</label>
                        <input type="text" id="imap_host" name="imap_host" required value="imap.hostinger.com"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="imap_port" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Porta IMAP</label>
                        <input type="number" id="imap_port" name="imap_port" required value="993"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="imap_encryption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Encriptação</label>
                        <input type="text" id="imap_encryption" name="imap_encryption" required value="SSL"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="imap_validate_cert" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Validar Certificado</label>
                        <select id="imap_validate_cert" name="imap_validate_cert" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="1" selected>Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">
                            Adicionar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
