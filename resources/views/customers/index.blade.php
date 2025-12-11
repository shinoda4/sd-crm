<x-app-layout>

    <x-title :name="__('客户列表')"/>

    <x-main>
        <x-tool-bar>
            <x-button :href="route('customers.create')" title="新建客户"/>

            <x-search-form :action="route('customers.index')" placeholder="搜索客户"/>

        </x-tool-bar>

        <x-table>
            <x-table-thead>
                <tr>
                    <x-table-th>名称</x-table-th>
                    <x-table-th>公司</x-table-th>
                    <x-table-th>联系人数</x-table-th>
                    <x-table-th>商机数</x-table-th>
                    <x-table-th>操作</x-table-th>
                </tr>
            </x-table-thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($customers as $c)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('customers.show', $c) }}" class="text-blue-600 hover:underline">
                            {{ $c->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">{{ $c->company ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('customers.contacts.index', $c->id) }}" class="text-blue-600 underline">
                            {{ $c->contacts()->count() }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('customers.deals.index', $c->id) }}"
                           class="text-blue-600 underline">
                            {{ $c->deals()->count() }}
                        </a>
                    </td>
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
        </x-table>

    </x-main>

    {{-- 分页 --}}
    <div class="mt-4">
        {{ $customers->links() }}
    </div>

</x-app-layout>
