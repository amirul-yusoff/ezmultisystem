@extends('dashboard.index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Permission</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3>Name: {{$members->name}}</h3>
                    <h4>Email: {{$members->email}}</h4>
                </div>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <a href="{{url()->previous()}}"><i class="fa-solid fa-arrow-left-long"></i></a>
                </button>
            </div>
        </div>
        <div class="card-body">
            {{-- <h5 class="card-title">Role</h5>
            <p class="card-text">Role</p> --}}
            <form>
              <dl>
                  <dt>Role</dt>
                      <dd>Role</dd>
                  <dt>Permission</dt>
                      <dd>Permission</dd>
              </dl>
            </form>
        </div>
    </div>
</div>
@endsection