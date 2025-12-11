@props(['stage' => null])

<div class="space-y-4">

    <div>
        <label class="block mb-1 font-medium">阶段名称</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $stage->name ?? '') }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required
        >
    </div>


    <div>
        <label class="block mb-1 font-medium">排序（越小越靠前）</label>
        <input
            type="number"
            name="order"
            value="{{ old('order', $stage->order ?? 0) }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            required
        >
    </div>


    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded"
    >
        保存
    </button>
</div>
