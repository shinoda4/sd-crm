@props(['customers', 'pipelineStages', 'deal'=>null])

<div class="mb-4">
    <label class="block mb-1 font-medium">标题</label>
    <input
        type="text"
        name="title"
        value="{{ old('title', $deal->title) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        required
    >
</div>

<x-dropdown-search-select
    label="客户名称"
    :items="$customers"
    placeholder="搜索客户"
    :search="$deal->customer->name ?? ''"
    :selected-id="$deal->customer->id ?? null"
    name="customer_id"
    id="customer-dropdown"
/>

<x-dropdown-search-select
    label="销售过程"
    :items="$pipelineStages"
    placeholder="搜索销售过程"
    :search="$deal->stage->name ?? ''"
    :selected-id="$deal->pipeline_stage_id"
    name="pipeline_stage_id"
    id="pipeline-dropdown"
/>

<div class="mb-4">
    <label class="block mb-1 font-medium">金额</label>
    <input
        type="text"
        name="amount"
        value="{{ old('amount', $deal->amount) }}"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
    >
</div>


<div class="mb-4">
    <label class="block mb-1 font-medium">备注</label>
    <textarea
        name="note"
        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        rows="3"
    >{{old('note', $deal->note)}}</textarea>
</div>

<button
    type="submit"
    class="bg-blue-600 text-white px-4 py-2 rounded"
>
    保存
</button>

