<x-app-layout>
    <x-title :name="__('联系人列表')"/>

    <x-main>
        <x-tool-bar>
            <x-button :href="route('contacts.create')" title="新建联系人"/>
            <x-search-form
                :action="route('customers.contacts.index', $customer->id)"
                placeholder="搜索联系人"/>
        </x-tool-bar>

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
    </x-main>

    {{-- 分页 --}}
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>

</x-app-layout>
