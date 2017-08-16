@extends('users-mgmt.base')
@section('action-content')
 <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Profile - {{ Auth::user()->username}}</h3>
        </div>
        <div class="col-sm-4">
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
<h1>Hello {{ Auth::user()->username}}, comming soon</h1>
</div>
</div>
</section>
</div>
@endsection