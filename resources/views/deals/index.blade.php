<x-app-layout>

    <x-title :name="__('商机列表')"/>

    <x-main>
        <x-tool-bar>
            <x-button :href="route('deals.create')" title="新增商机"/>
            <x-search-form :action="route('deals.index')" placeholder="搜索商机"/>
        </x-tool-bar>

        <x-table>
            <x-table-thead>
                <tr>
                    <x-table-th>标题</x-table-th>
                    <x-table-th>客户</x-table-th>
                    <x-table-th>负责人</x-table-th>
                    <x-table-th>阶段</x-table-th>
                    <x-table-th>金额</x-table-th>
                    <x-table-th>操作</x-table-th>

                </tr>
            </x-table-thead>

            <tbody>
            @foreach($deals as $deal)
                <tr>
                    <td class="border px-3 py-2">
                        <a href="{{ route('deals.show', $deal) }}" class="text-blue-600 hover:underline">
                            {{ $deal->title }}
                        </a>

                    </td>
                    <td class="border px-3 py-2">{{ $deal->customer->name }}</td>
                    <td class="border px-3 py-2">{{ $deal->owner->name }}</td>
                    <td class="border px-3 py-2">{{ $deal->stage->name }}</td>
                    <td class="border px-3 py-2">{{ $deal->amount }}</td>
                    <td class="border px-3 py-2">
                        <a href="{{ route('deals.edit', $deal) }}"
                           class="text-blue-600 hover:underline">
                            编辑
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-table>
    </x-main>

</x-app-layout>
