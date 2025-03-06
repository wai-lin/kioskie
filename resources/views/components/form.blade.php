@props([
    'class',
    'action',
    'method' => 'post',
    'upload' => false,
])

<form
    class="{{$class}}"
    action="{{$action}}"
    method="POST"
    @if($upload) enctype="multipart/form-data" @endif
>
    @csrf
    @if($method == 'put')
        @method('PUT')
    @elseif($method == 'patch')
        @method('PATCH')
    @elseif($method == 'delete')
        @method('DELETE')
    @endif

    {{$slot}}
</form>
