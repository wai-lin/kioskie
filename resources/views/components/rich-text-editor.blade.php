@props([
    'name',
    'label',
    'id' => null,
    'placeholder' => null,
    'class' => null,
    'value' => null,
])

<flux:field>

    <flux:label>{{$label}}</flux:label>

    <flux:error :name="$name"/>

    <textarea
        name="{{$name}}"
        id="{{$id}}"
        value="{{$value}}"
        placeholder="{{$placeholder}}"
        class="editor {{$class}}"
    >{{old($name, $value)}}</textarea>

</flux:field>

@once
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js"
            integrity="sha512-RnlQJaTEHoOCt5dUTV0Oi0vOBMI9PjCU7m+VHoJ4xmhuUNcwnB5Iox1es+skLril1C3gHTLbeRepHs1RpSCLoQ=="
            crossOrigin="anonymous"></script>

    <script>
        const editor_config = {
            relative_urls: false,
            path_absolute: "{{config('app.url')}}",
            selector: '.editor',
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks fullscreen',
                'contextmenu paste help wordcount code'
            ],
            toolbar: ' undo redo |  bold italic | link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | removeformat | code | help',
        }
        tinymce.init(editor_config);
    </script>
@endonce
