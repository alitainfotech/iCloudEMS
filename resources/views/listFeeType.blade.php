
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
      <h4 class="card-title">FeeType List</h4>

      <div class="table-responsive">
        <table id="#" class="display" style="width:100%">
          <thead>

            <tr>
                <th>
                    No
                </th>
              <th>
                  FeeID
              </th>
              <th>
                  FeeName
              </th>
              <th>
                  CollectionID
              </th>
              <th>Branch</th>
              <th>SeqID</th>
              <th>FeeTypeLedger</th>

            </tr>
          </thead>
          <tbody>

              @foreach ($listFeeTypeData as $key=>$list)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$list->fee_id}}</td>
                      <td>{{$list->f_name}}</td>
                      <td>{{$list->feecollection->collectionhead}}</td>
                      <td>{{(isset($list->branch) && $list->branch->name)  ? $list->branch->name : "" }}</td>
                      <td>{{$list->seq_id}}</td>
                      <td>{{$list->fee_type_ledger}}</td>
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

