@if ($errors and count($errors))
    <ul>
        @foreach ($errors->all() as $err)
            <li class="text-danger" style="list-style:none;">{{ $err }}</li>
        @endforeach
    </ul>
@endif
