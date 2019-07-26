@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        @if (!Auth::guest())
                            {{ Auth::user()->name }}
                        @endif
                            <a href="{{ route('addUserData') }}" class="btn btn-sm btn-primary" style="float: right;">Add</a>
                    </h2>
                </div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($data as $item)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->phone }}</td>
                              <td>
                                  <a href="{{ route('editUserData', [$item->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                  <a href="{{ route('trashUserData', [$item->id]) }}" class="btn btn-success btn-sm">Trash</a>
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
