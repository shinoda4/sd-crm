<form action="{{ $action }}" method="GET" class="flex space-x-2">
    <input type="text" name="search" value="{{ $search ?? '' }}"
           placeholder="{{$placeholder}}"
           class="px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
        搜索
    </button>
</form>
