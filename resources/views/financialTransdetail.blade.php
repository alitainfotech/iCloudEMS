
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
              FinancialTranName
              </th>
              <th>
              ModuleName
              </th>
              <th>
              Amount
              </th>
              <th>crdr</th>
              <th>BrancheName</th>
              <th>head_name</th>
             
            </tr>
          </thead>
          <tbody>

              @foreach ($listfinancialTransdetaildata as $key=>$list)
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$list->financialtran_id}}</td>
                      <td>
                        @php
                          if(isset($list->module->module)){
                            echo $list->module->module;
                          }
                          
                        @endphp
                      </td>
                      <td>{{$list->amount}}</td>
                      <td>{{$list->crdr}}</td>
                      <td>
                        @php
                          if(isset($list->branch->name)){
                            echo $list->branch->name;
                          }
                          
                        @endphp
                      </td>
                      <td>{{$list->head_name}}</td>
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

