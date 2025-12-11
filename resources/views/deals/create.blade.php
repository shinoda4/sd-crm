<x-app-layout>
    <x-title :name="__('新建商机')"/>
    <x-main>
        <x-card>
            <form action="{{ route('deals.store') }}" method="POST" class="space-y-4">
                @csrf
                <x-deal.form
                    :customers="$customers"
                    :pipelineStages="$stages"
                />
            </form>
        </x-card>
    </x-main>
</x-app-layout>
