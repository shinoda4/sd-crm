<x-app-layout>
    <x-title :name="__('创建销售流程')"/>

    <x-main>


        <x-card>
            <form action="{{route('pipeline-stages.store')}}" method="POST" class="space-y-4">
                @csrf
                <x-pipeline-stage.form/>
            </form>
        </x-card>
    </x-main>
</x-app-layout>
