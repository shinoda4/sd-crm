<x-app-layout>
    <x-title :name="__('商机详情')"/>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md mt-6">
        <h1 class="text-3xl font-bold mb-6">{{ $deal->title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <span class="font-semibold text-gray-700">amount：</span>
                <span class="text-gray-800">{{ $deal->amount ?? '-' }}</span>
            </div>


        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('deals.edit', $deal) }}"
               class="px-5 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                编辑
            </a>
            <form action="{{ route('deals.destroy', $deal) }}" method="POST"
                  onsubmit="return confirm('确定要删除吗？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-5 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                    删除
                </button>
            </form>
            <a href="{{ route('deals.index') }}"
               class="px-5 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
                返回列表
            </a>
        </div>
    </div>
</x-app-layout>
