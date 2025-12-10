<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->

<div>
    <label class="block text-gray-700 font-medium mb-1">名称</label>
    <input type="text" name="name" value="{{ old('name', $customer->name) }}" required
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    @error('name')
    <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
    @enderror
</div>

<div>
    <label class="block text-gray-700 font-medium mb-1">公司</label>
    <input type="text" name="company" value="{{ old('company', $customer->company) }}"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

<div>
    <label class="block text-gray-700 font-medium mb-1">邮箱</label>
    <input type="email" name="email" value="{{ old('email', $customer->email) }}"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

<div>
    <label class="block text-gray-700 font-medium mb-1">电话</label>
    <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

<div>
    <label class="block text-gray-700 font-medium mb-1">行业</label>
    <input type="text" name="industry" value="{{ old('industry', $customer->industry) }}"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

<div>
    <label class="block text-gray-700 font-medium mb-1">标签（逗号分隔）</label>
    @php
        $tags = old('tags', $customer->tags);
        if (!is_array($tags)) {
            $tags = $tags ? explode(',', $tags) : [];
        }
    @endphp
    <input type="text" name="tags" value="{{ implode(',', $tags) }}"
           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>
<div class="flex flex-wrap gap-3">
    <button type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow">
        保存
    </button>
    <a href="{{ route('customers.index') }}"
       class="px-5 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
        返回列表
    </a>
</div>


