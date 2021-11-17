
@extends('template.master')
@section('pagestyle')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<style>
  div.dataTables_wrapper {
        margin-bottom: 3em;
    }
</style>
@endsection
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Branch List</h4>

      <div class="table-responsive">
        <table id="#" class="display" style="width:100%">
          <thead>
            <tr>
              <th>
                  No
              </th>
            <th>
                BranchName
            </th>
          </tr>
        </thead>
          <tbody>

            @foreach ($listBranchdata as $list)
              <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->name}}</td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection


@section('ajaxscript')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>

@endsection































