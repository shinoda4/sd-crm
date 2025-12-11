<x-app-layout>
    <x-title :name="__('新建客户')"/>
    <x-main>
        <x-card>
            <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-customer.form/>
            </form>
        </x-card>

    </x-main>

</x-app-layout>
