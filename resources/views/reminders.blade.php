@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Reminders
                        <a href="{{ route('addReminder') }}" class="btn btn-sm btn-primary" style="float: right;">Add</a>
                    </h3>
                </div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Reminder</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($reminders as $reminder)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $reminder->name }}</td>
                              <td>
                                  <a href="{{ route('editReminder', [$reminder->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                  <a href="{{ route('deleteReminder', [$reminder->id]) }}" class="btn btn-success btn-sm">Delete</a>
                              </td>
                            </tr>
                        @empty
                            <tr>
                              <th scope="row" colspan="3" class="text-center">Data not found</th>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
