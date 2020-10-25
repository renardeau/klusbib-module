@extends('layouts/default')

{{-- Page title --}}
@section('title')

@if (Input::get('status')=='deleted')
    {{ trans('general.deleted') }}
@else
    {{ trans('general.current') }}
@endif
{{ trans('klusbib::general.deliveries') }}

@parent
@stop

@section('header_right')
    @can('create', \Modules\Klusbib\Models\Api\Delivery::class)
      <a href="{{ route('klusbib.deliveries.create') }}" class="btn btn-primary pull-right" style="margin-right: 5px;">  {{ trans('general.create') }}</a>
    @endcan

    @if (Input::get('status')=='deleted')
      <a class="btn btn-default pull-right" href="{{ route('klusbib.deliveries.index') }}" style="margin-right: 5px;">{{ trans('klusbib::admin/deliveries/table.show_current') }}</a>
    @else
      <a class="btn btn-default pull-right" href="{{ route('klusbib.deliveries.index', ['status' => 'deleted']) }}" style="margin-right: 5px;">{{ trans('klusbib::admin/deliveries/table.show_deleted') }}</a>
    @endif
    @can('view', \Modules\Klusbib\Models\Api\Delivery::class)
        <a class="btn btn-default pull-right" href="{{ route('klusbib.deliveries.export') }}" style="margin-right: 5px;">Export</a>
    @endcan
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
        <div class="box-body">
{{--          {{ Form::open([--}}
{{--               'method' => 'POST',--}}
{{--               'route' => ['users/bulkedit'],--}}
{{--               'class' => 'form-inline',--}}
{{--                'id' => 'bulkForm']) }}--}}

            {{--@if (Input::get('status')!='deleted')--}}
              {{--@can('delete', \App\Models\Delivery::class)--}}
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
                    data-columns="{{ \Modules\Klusbib\Presenters\DeliveryPresenter::dataTableLayout() }}"
                    data-cookie-id-table="deliveriesTable"
                    data-pagination="true"
                    data-id-table="deliveriesTable"
                    data-search="true"
                    data-side-pagination="server"
                    data-show-columns="true"
                    data-show-export="true"
                    data-show-refresh="true"
                    data-sort-order="asc"
                    data-toolbar="#toolbar"
                    id="deliveriesTable"
                    class="table table-striped snipe-table"
                    data-url="{{ route('api.klusbib.deliveries.index',
              array('deleted'=> (Input::get('status')=='deleted') ? 'true' : 'false','company_id'=>e(Input::get('company_id')))) }}"
                    data-export-options='{
                "fileName": "export-deliveries-{{ date('Y-m-d') }}",
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
@include ('partials.bootstrap-table')
@include ('klusbib::partials.custom-bootstrap-table')

@stop
