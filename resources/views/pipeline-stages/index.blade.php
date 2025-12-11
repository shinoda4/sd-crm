<x-app-layout>
    <x-title :name="__('销售流程')"/>

    <x-main>
        <x-tool-bar>
            <x-button :href="route('pipeline-stages.create')" title="创建销售流程"/>
            <x-search-form :action="route('pipeline-stages.index')" placeholder="搜索销售流程"/>
        </x-tool-bar>

        <x-table>
            <x-table-thead>
                <tr>
                    <x-table-th>名称</x-table-th>
                    <x-table-th>顺序</x-table-th>
                    <x-table-th>操作</x-table-th>
                </tr>
            </x-table-thead>

            <tbody class="divide-y divide-gray-200">
            @foreach($stages as $c)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('pipeline-stages.show', $c) }}" class="text-blue-600 hover:underline">
                            {{ $c->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">{{ $c->order ?? '-' }}</td>


                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('pipeline-stages.edit', $c) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">编辑</a>
                        <form action="{{ route('pipeline-stages.destroy', $c) }}" method="POST" class="inline">
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
</x-app-layout>
