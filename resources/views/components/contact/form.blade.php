<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
@props(['customers'])


<div class="mb-4">
    <label class="block mb-1 font-medium">姓名</label>
    <input
        type="text"
        name="name"
        value="{{ old('name', $contact->name) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
</div>

<div class="mb-4">
    <label class="block mb-1 font-medium">职务</label>
    <input
        type="text"
        name="title"
        value="{{ old('title', $contact->title) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
</div>

<div class="mb-4">
    <label class="block mb-1 font-medium">邮箱</label>
    <input
        type="email"
        name="email"
        value="{{ old('email', $contact->email) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
</div>

<div class="mb-4">
    <label class="block mb-1 font-medium">电话</label>
    <input
        type="text"
        name="phone"
        value="{{ old('phone', $contact->phone) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
</div>
<x-dropdown-search-select
    label="客户名称"
    :items="$customers"
    placeholder="搜索客户"
    :search="$contact->customer->name ?? ''"
    :selected-id="$contact->customer->id ?? ''"
    name="customer_id"
/>


<div class="mb-4">
    <label class="block mb-1 font-medium">备注</label>
    <textarea
        name="notes"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        rows="3"
    ></textarea>
</div>

<button
    type="submit"
    class="bg-blue-600 text-white px-4 py-2 rounded"
>
    保存
</button>

