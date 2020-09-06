@extends('layouts/default')

{{-- Page title --}}
@section('title')

@if (Input::get('status')=='deleted')
    {{ trans('general.deleted') }}
@else
    {{ trans('general.current') }}
@endif
{{ trans('klusbib::general.memberships') }}

@parent
@stop

@section('header_right')
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-body">
          {{--{{ Form::open([--}}
               {{--'method' => 'POST',--}}
               {{--'route' => ['memberships/bulkedit'],--}}
               {{--'class' => 'form-inline',--}}
                {{--'id' => 'bulkForm']) }}--}}

            {{--@if (Input::get('status')!='deleted')--}}
              {{--@can('delete', \Modules\Klusbib\Models\Api\Membership::class)--}}
                {{--<div id="toolbar">--}}
                  {{--<select name="bulk_actions" class="form-control select2" style="width: 200px;">--}}
                    {{--<option value="delete">Bulk Checkin &amp; Delete</option>--}}
                    {{--<option value="edit">Bulk Edit</option>--}}
                  {{--</select>--}}
                  {{--<button class="btn btn-default" id="bulkEdit" disabled>Go</button>--}}
                {{--</div>--}}
              {{--@endcan--}}
            {{--@endif--}}


            <table
                    data-click-to-select="true"
                    data-columns="{{ \Modules\Klusbib\Presenters\MembershipPresenter::dataTableLayout() }}"
                    data-cookie-id-table="membershipsTable"
                    data-pagination="true"
                    data-id-table="membershipsTable"
                    data-search="true"
                    data-side-pagination="server"
                    data-show-columns="true"
                    data-show-export="true"
                    data-show-refresh="true"
                    data-sort-order="desc"
                    data-toolbar="#toolbar"
                    id="membershipsTable"
                    class="table table-striped snipe-table"
                    data-url="{{ route('api.klusbib.memberships.index',
              array('deleted'=> (Input::get('status')=='deleted') ? 'true' : 'false','company_id'=>e(Input::get('company_id')))) }}"
                    data-export-options='{
                "fileName": "export-memberships-{{ date('Y-m-d') }}",
                "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                }'>
            </table>


{{--          {{ Form::close() }}--}}
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  </div>
</div>

@stop

@section('moar_scripts')
{{-- include klusbib bootstrap-table to allow addition of klusbib specific formatters --}}
@include ('klusbib::partials.custom-bootstrap-table')

@stop
