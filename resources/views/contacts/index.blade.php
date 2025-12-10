<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('联系人列表') }}
            </h2>

        </div>
    </x-slot>


    <div class="overflow-x-auto mt-2">
        <div class="m-2 flex justify-between">
            <a href="{{ route('contacts.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                新建联系人
            </a>
            <form action="{{ route('contacts.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="搜索联系人"
                       class="px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                    搜索
                </button>
            </form>
        </div>

        <table class="min-w-full border border-gray-200 bg-white shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">姓名</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">标题</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">手机号</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">邮箱</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">操作</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($contacts as $c)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('contacts.show', $c) }}" class="text-blue-600 hover:underline">
                            {{ $c->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">{{ $c->title ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $c->phone }}</td>
                    <td class="px-6 py-4">{{ $c->email }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('contacts.edit', $c) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">编辑</a>
                        <form action="{{ route('contacts.destroy', $c) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('确认删除?')"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                删除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- 分页 --}}
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>

</x-app-layout>
