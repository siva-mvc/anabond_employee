@extends('system-mgmt.factor.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">

  <!-- /.box-header -->
  <div class="box-body">
               @if($errors->any())
                <div class="alert alert-error">{{$errors->first()}}</div>
                @endif

      <form method="POST" action="{{ route('factor.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row" >
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row" style="background-color:#d9d9d9" >
                <th width="42%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Factor Name</th>
                <th width="42%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Department Name</th>
   
                <th tabindex="0" aria-controls="example2" rowspan="1" > <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('factor.create') }}">Add Performance Factor</a>
        </div></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($factors as $factor)
                <tr role="row" class="odd">
                  <td>{{ $factor->name }}</td>
                  <td>{{ $factor->department_name }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('factor.destroy', ['id' => $factor->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('factor.edit', ['id' => $factor->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <!-- <tfoot>
              <tr>
                <th width="20%" rowspan="1" colspan="1">Team Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($factors)}} of {{count($factors)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">


             {{ $factors->appends([isset($searchingVals) ? $searchingVals['name'] : '1'])->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection