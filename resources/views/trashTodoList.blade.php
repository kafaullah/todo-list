@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Trash Todo List</h3>
                </div>

                <div class="card-body">
                  @if(session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                  @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">name</th>
                          <th scope="col">Reminder</th>
                          <th scope="col">Reminder Start Date</th>
                          <th scope="col">Reminder End Date</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($todos as $todo)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $todo->name }}</td>
                              <td>{{ $todo->reminder->name }}</td>
                              <td>{{ $todo->start_date }}</td>
                              <td>{{ $todo->end_date }}</td>
                              <td>
                                  <a href="{{ route('restoreTodo', [$todo->id]) }}" class="btn btn-primary btn-sm">Restore</a>
                                  <a href="{{ route('deleteTodo', [$todo->id]) }}" class="btn btn-success btn-sm">Delete</a>
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
