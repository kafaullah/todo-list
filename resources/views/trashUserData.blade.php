@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Trash User Data
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
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($userData as $item)
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $item->email }}</td>
                              <td>{{ $item->phone }}</td>
                              <td>
                                  <a href="{{ route('restoreUserData', [$item->id]) }}" class="btn btn-primary btn-sm">Restore</a>
                                  <a href="{{ route('deleteUserData', [$item->id]) }}" class="btn btn-success btn-sm">Delete</a>
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
