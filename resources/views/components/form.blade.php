@props([
    'action',
    'post' => null,
    'put' => null,
    'delete' => null
])

<form action="{{ $action }}" method="post" class="space-y-4">
    @csrf

    @if($put)
        @method('PUT')
    @endif

    @if($delete)
        @method('DELETE')
    @endif

    {{ $slot }}
</form>
