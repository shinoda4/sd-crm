<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('新建联系人') }}
            </h2>

        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-semibold mb-6">创建联系人</h2>
        <form method="POST" action="{{ route('contacts.store') }}" x-data="contactForm()">
            @csrf

            <x-contact.form :customers="$customers"/>

        </form>

    </div>
</x-app-layout>
