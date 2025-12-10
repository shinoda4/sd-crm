<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('客户列表') }}
            </h2>

        </div>
    </x-slot>

    <div class="overflow-x-auto mt-2">
        <div class="m-2 flex justify-between">
            <a href="{{ route('customers.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                新建客户
            </a>
            <form action="{{ route('customers.index') }}" method="GET" class="flex space-x-2">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                       placeholder="搜索客户"
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
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">名称</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">公司</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">联系人数</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">商机数</th>
                <th class="px-6 py-3 text-left text-gray-700 uppercase text-sm font-medium">操作</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($customers as $c)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('customers.show', $c) }}" class="text-blue-600 hover:underline">
                            {{ $c->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">{{ $c->company ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $c->contacts()->count() }}</td>
                    <td class="px-6 py-4">{{ $c->deals()->count() }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('customers.edit', $c) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">编辑</a>
                        <form action="{{ route('customers.destroy', $c) }}" method="POST" class="inline">
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
        {{ $customers->links() }}
    </div>

</x-app-layout>
