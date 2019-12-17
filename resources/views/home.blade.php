@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Send Push Notofications from Laravel to Android</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php($count = 1)
                        @foreach ($users as $user )
                        <tr>
                        <th scope="row">{{$count}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{ route('sendToSingleUser', ['id' => $user->id ]) }}" class="btn btn-primary btn-sm">Send Notification to this User </a></td>
                        </tr>
                        @php($count++)
                      @endforeach
                    </tbody>
                  </table>
                <a href="{{ route('sendAllSingleUsers') }}" class="btn btn-success">Send Notification To All </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
