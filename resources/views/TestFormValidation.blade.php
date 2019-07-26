@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Item</h3>
                    @if ($errors->all())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                </div>

                <div class="card-body">
                    <form method="post" onsubmit="return send()" id="formid" action="{{ route('validation') }}">
                        @csrf
                        <div class="">
                            <input type="text" name="name">
                            @if ($errors->has('name'))
                                <label style="color:red;">{{ $errors->first('name') }}</label>
                            @endif
                        </div>
                        <div class="">
                            <input type="text" name="address">
                            @if ($errors->has('address'))
                                <label style="color:red;">{{ $errors->first('address') }}</label>
                            @endif
                        </div>
                        <div class="">
                            <input type="text" name="address2">
                            @if ($errors->has('address2'))
                                <label style="color:red;">{{ $errors->first('address2') }}</label>
                            @endif
                        </div>
                        <div>
                            <input type="submit" name="saveItem">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    function send(){
        // var form = document.querySelector('#formid');
        var formData = $( "#formid" ).serialize();
        
        
        // $.post('{{ URL::to("validation") }}', {formData:formData }, function(data){
        //     console.log(formData);
        // });
        $.ajax({
               type:'POST',
               url:'/validation',
               data:{'_token' : '<?php echo csrf_token() ?>', 'formData':formData},
               success:function(data) {
                  console.log(data);
               }
            });
        return false;
    }
</script>
@endsection
