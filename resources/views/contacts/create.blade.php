<x-app-layout>
    <x-title :name="__('新建联系人')"/>

    <x-main>


        <x-card>
            <form method="POST" action="{{ route('contacts.store') }}" x-data="contactForm()">
                @csrf

                <x-contact.form :customers="$customers"/>

            </form>
        </x-card>
    </x-main>
</x-app-layout>
