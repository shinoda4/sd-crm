<x-app-layout>
    <x-title :name="__('销售流程详情')"/>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold mb-6">{{ $pipelineStage->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <span class="font-semibold text-gray-700">名称：</span>
                <span class="text-gray-800">{{ $pipelineStage->name ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">顺序：</span>
                <span class="text-gray-800">{{ $pipelineStage->order ?? '-' }}</span>
            </div>

        </div>

        {{--        <div class="mb-6">--}}
        {{--            <h2 class="text-2xl font-semibold mb-3">相关活动</h2>--}}
        {{--            @if($customer->activities->isEmpty())--}}
        {{--                <p class="text-gray-500">暂无活动</p>--}}
        {{--            @else--}}
        {{--                <ul class="space-y-2">--}}
        {{--                    @foreach($customer->activities as $activity)--}}
        {{--                        <li class="p-3 border border-gray-200 rounded shadow-sm">--}}
        {{--                            <span class="font-semibold text-gray-700">{{ $activity->user->name ?? '系统' }}:</span>--}}
        {{--                            <span class="text-gray-800">{{ $activity->content }}</span>--}}
        {{--                            <small class="text-gray-400 ml-2">({{ $activity->created_at->format('Y-m-d H:i') }})</small>--}}
        {{--                        </li>--}}
        {{--                    @endforeach--}}
        {{--                </ul>--}}
        {{--            @endif--}}
        {{--        </div>--}}

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('pipeline-stages.edit', $pipelineStage) }}"
               class="px-5 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                编辑
            </a>
            <form action="{{ route('pipeline-stages.destroy', $pipelineStage) }}" method="POST"
                  onsubmit="return confirm('确定要删除吗？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                    删除
                </button>
            </form>
            <a href="{{ route('pipeline-stages.index') }}"
               class="px-5 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
                返回列表
            </a>
        </div>
    </div>
</x-app-layout>
