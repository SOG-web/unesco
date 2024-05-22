@if($errors->any())
    <ul class="my-1.5">
        @foreach($errors->all() as $error)
            <li class="text-red-500 italic text-center">{{ $error }}</li>
        @endforeach
    </ul>
@endif
