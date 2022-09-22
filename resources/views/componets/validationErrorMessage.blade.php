@if ($errors AND count($errors))
    <ul>
        @foreach ($errors->all() as $err)
            <li class="text-danger">{{$err}}</li>
        @endforeach
    </ul>
@endif
