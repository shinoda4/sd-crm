<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('联系人详情') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold mb-6">{{ $contact->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <span class="font-semibold text-gray-700">姓名：</span>
                <span class="text-gray-800">{{ $contact->name ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">职位：</span>
                <span class="text-gray-800">{{ $contact->title ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">邮箱：</span>
                <span class="text-gray-800">{{ $contact->email ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">电话：</span>
                <span class="text-gray-800">{{ $contact->phone ?? '-' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">备注：</span>
                <span class="text-gray-800">{{ $contact->note ?? '-' }}</span>
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
            <a href="{{ route('contacts.edit', $contact) }}"
               class="px-5 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                编辑
            </a>
            <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                  onsubmit="return confirm('确定要删除吗？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                    删除
                </button>
            </form>
            <a href="{{ route('contacts.index') }}"
               class="px-5 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
                返回列表
            </a>
        </div>
    </div>
</x-app-layout>
