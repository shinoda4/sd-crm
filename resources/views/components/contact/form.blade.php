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

<div class="mb-4" @click.away="open = false">
    <label class="block mb-1 font-medium">客户名称</label>

    <input
        type="text"
        placeholder="搜索客户…"
        class="w-full border rounded px-3 py-2"
        x-model="search"
        @input="filterCustomers()"
        @focus="open = true"
    >

    <input type="hidden" name="customer_id" :value="selectedId">

    <div
        class="border rounded mt-1 bg-white max-h-40 overflow-y-auto"
        x-show="open"
    >
        <template x-for="c in filteredCustomers" :key="c.id">
            <div
                class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                @click="selectCustomer(c)"
                x-text="c.name"
            ></div>
        </template>
    </div>
</div>

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


<script>

    function contactForm() {
        return {
            open: false,
            search: '{{ $contact->customer->name ?? '' }}',
            selectedId: {{ $contact->customer_id ?? 'null' }},
            customers: @json($customers),   // 由 Controller 注入
            filteredCustomers: [],

            filterCustomers() {
                this.filteredCustomers = this.customers.filter(c =>
                    c.name.toLowerCase().includes(this.search.toLowerCase())
                );
            },

            selectCustomer(c) {
                this.search = c.name;
                this.selectedId = c.id;
                this.open = false;
            }
        }
    }
</script>
