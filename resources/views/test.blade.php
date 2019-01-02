@extends('layouts.app')

@section('content')
<div class="container">

	<div class="col-sm-12">
 php var to js
 <form action="{{ route('test.store') }}" method="post">
    {{ csrf_field() }}
    @foreach($data as $data)
        <input type="hidden" name="data[]" value="{{ $data }}">
    @endforeach
    <input type="submit" value="Send">
 </form>
    </div>

</div>
@include('footer') {{--  variables depend to this view  --}}
<script type="text/javascript">
    $(document).ready(function(){
        console.log(window);
    });
</script>
@endsection
