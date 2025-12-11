@props([
    'label',
    'placeholder' => '',
    'name',
    'items' => [],
    'search' => '',
    'selectedId' => null,
])

<div class="mb-4" @click.away="open = false"
     x-data="itemField(@js($search), @js($selectedId), @js($items))">
    <label class="block mb-1 font-medium">{{ $label }}</label>

    <input
        type="text"
        placeholder="{{ $placeholder }}…"
        class="w-full border rounded px-3 py-2"
        x-model="search"
        @input="filterItems()"
        @focus="open = true"
    >

    <input type="hidden" name="{{ $name }}" :value="selectedId">

    <div
        class="border rounded mt-1 bg-white max-h-40 overflow-y-auto"
        x-show="open"
    >
        <template x-for="c in filteredItems" :key="c.id">
            <div
                class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                @click="selectItem(c)"
                x-text="c.name"
            ></div>
        </template>
    </div>
</div>

<script>
    function itemField(initialSearch = '', initialSelectedId = null, items = []) {
        console.log({{$selectedId}})
        return {
            open: false,
            search: initialSearch,
            selectedId: initialSelectedId,
            items: items,
            filteredItems: [],

            filterItems() {
                this.filteredItems = this.items.filter(c =>
                    c.name.toLowerCase().includes(this.search.toLowerCase())
                );
            },

            selectItem(c) {
                this.search = c.name;
                this.selectedId = c.id;
                this.open = false;
            }
        }
    }
</script>
