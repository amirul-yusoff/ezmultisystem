@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>{{$members->username}}</h3>
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url()->previous()}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form>
              <dl>
                <dt>Username</dt>
                    <dd>{{$members->name}}</dd>
                <dt>Email</dt>
                    <dd>{{$members->email}}</dd>
                <dt>Status</dt>
                    <dd>{{$members->status}}</dd>
              </dl>
            </form>
        </div>
    </div>
</div>
@endsection