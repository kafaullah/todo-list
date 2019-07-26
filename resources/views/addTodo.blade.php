@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Todo </h3>
                </div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <form method="post" action="{{ route('saveTodo') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            @if ($errors->has('name'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="reminder_id">Reminder Type</label>
                            <select class="form-control" id="reminder_id" name="reminder_id">
                              <option value="" selected="selected">Select Reminder Type</option>
                              @foreach($reminders  as $reminder)
                              <option value="{{ $reminder->id }}">{{ $reminder->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="start_date">Start Date</label>
                              <input type="date" name="start_date" class="form-control" id="start_date">
                              @if ($errors->has('start_date'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('start_date') }}</small>
                              @endif
                            </div>
                            <div class="form-group col-md-6">
                              <label for="end_date">End Date</label>
                              <input type="date" name="end_date" class="form-control" id="end_date">
                              @if ($errors->has('end_date'))
                                <small id="name" class="form-text text-danger">{{ $errors->first('end_date') }}</small>
                              @endif
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
