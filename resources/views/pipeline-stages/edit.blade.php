<x-app-layout>
    <x-title :name="__('编辑销售流程')"/>

    <x-main>
        <x-card>
            <form action="{{route('pipeline-stages.update', $pipelineStage)}}" method="POST">
                @csrf
                @method('PATCH')
                <x-pipeline-stage.form :stage="$pipelineStage"/>
            </form>
        </x-card>
    </x-main>
</x-app-layout>
