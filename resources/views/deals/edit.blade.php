<x-app-layout>
    <x-title :name="__('编辑商机')"/>

    <x-main>
        <x-card>
            <form action="{{ route('deals.update', $deal) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <x-deal.form
                    :deal="$deal"
                    :customers="$customers"
                    :pipelineStages="$stages"/>
            </form>
        </x-card>
    </x-main>

</x-app-layout>
