@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('reports::reportmasters.title.reportmasters') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('reports::reportmasters.title.reportmasters') }}</li>
    </ol>
@stop

@push('css-stack')

   

@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div id="reportmaster-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Module</th>
                            <th>Query</th>
                            <th>Orientation</th>
                            <th>Papersize</th>
                            <th>Type</th>
                            <th>Class</th>
                            <th>Frequency</th>
                            <th>Is Month</th>
                            <th>Code</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($reportmasters)): ?>
                        <?php foreach ($reportmasters as $reportmaster): ?>
                        <tr>
                            <td>{{$reportmaster->name}}</td>
                            <td>{{$reportmaster->module_id}}</td>
                            <td>{{$reportmaster->query}}</td>
                            <td>{{$reportmaster->orientation}}</td>
                            <td>{{$reportmaster->papersize}}</td>
                            <td>{{$reportmaster->type}}</td>
                            <td>{{$reportmaster->class}}</td>
                            <td>{{$reportmaster->frequency}}</td>
                            <td>{{$reportmaster->is_mnth_gnrtn}}</td>
                            <td>{{$reportmaster->code}}</td>
                            <td>
                                <a href="{{ route('admin.reports.reportmaster.edit', [$reportmaster->id]) }}">
                                    {{ $reportmaster->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-default btn-flat category-edit-button" data-name="{{$reportmaster->name}}" data-module_id="{{$reportmaster->module_id}}" data-query="{{$reportmaster->query}}" data-orientation="{{$reportmaster->orientation}}" data-papersize="{{$reportmaster->papersize}}" data-type="{{$reportmaster->type}}" data-class="{{$reportmaster->class}}" data-frequency="{{$reportmaster->frequency}}" data-is_mnth_gnrtn="{{$reportmaster->is_mnth_gnrtn}}" data-format="{{$reportmaster->export_formats}}" data-code="{{$reportmaster->code}}" data-id="{{$reportmaster->id}}"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.reports.reportlog.destroy', [$reportmaster->id]) }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>
                    <!-- /.box-body -->
                </div>
                </div>
                <!-- /.box -->
            </div>
            <div id="update-div" class="box box-primary" hidden>
                <div class="box-header with-border">
                    <h3 class="box-title">Update Report Master</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.reports.reportmaster.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('module_id') ? ' has-error has-feedback' : '' }}">
                        <label for="module_id">Module</label>
                        {!! $errors->first('module_id', '<span class="help-block">:message</span>') !!}
                        <select class="module dropdown" id="itemName" name="module_id">
                            <option></option>
                            @foreach($reportmodules as $reportmodule)
                                <option value="{{$reportmodule->id}}">
                                    {{$reportmodule->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{ $errors->has('query') ? ' has-error has-feedback' : '' }}">
                        <label for="query">Query</label>
                        <input type="text" class="form-control" id="query"  name = "query" autofocus placeholder="Enter Query" value="{{ old('query') }}">
                        {!! $errors->first('query', '<span class="help-block">:message</span>') !!}
                    </div>
                        <div class="form-group {{ $errors->has('export_format') ? ' has-error has-feedback' : '' }}">
                            <label for="export_format">Export Format</label>
                            <input type="text" class="form-control" id="export-format"  name = "export_format" autofocus placeholder="Enter Export Format" value="{{ old('export_format') }}">
                            {!! $errors->first('export_format', '<span class="help-block">:message</span>') !!}
                        </div>
                        </div>
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('orientation') ? ' has-error has-feedback' : '' }}">
                        <label for="orientation">Orientation</label>
                        <input type="text" class="form-control" id="orientation"  name = "orientation" autofocus placeholder="Enter Orientation" value="{{ old('orientation') }}">
                        {!! $errors->first('orientation', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('papersize') ? ' has-error has-feedback' : '' }}">
                        <label for="papersize">PaperSize</label>
                        <input type="text" class="form-control" id="papersize"  name = "papersize" autofocus placeholder="Enter PaperSize" value="{{ old('papersize') }}">
                        {!! $errors->first('papersize', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('type') ? ' has-error has-feedback' : '' }}">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type"  name = "type" autofocus placeholder="Enter Type" value="{{ old('type') }}">
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                        <div class="form-group {{ $errors->has('code') ? ' has-error has-feedback' : '' }}">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code"  name = "code" autofocus placeholder="Enter Code" value="{{ old('code') }}">
                            {!! $errors->first('code', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('frequency') ? ' has-error has-feedback' : '' }}">
                        <label for="frequency">Frequency</label>
                        <input type="text" class="form-control" id="frequency"  name = "frequency" autofocus placeholder="Enter Frequency" value="{{ old('frequency') }}">
                        {!! $errors->first('frequency', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('is_mnth_gnrtn') ? ' has-error has-feedback' : '' }}">
                        <label for="is_mnth_gnrtn">Is Month Generation</label>
                        <div>
                            <input type="radio" name="is_mnth_gnrtn" value="1">
                            <label>Yes</label>
                            <input type="radio" name="is_mnth_gnrtn" value="0" checked>
                            <label>No</label>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('class') ? ' has-error has-feedback' : '' }}">
                        <label for="class">Class</label>
                        <input type="text" class="form-control" id="class"  name = "class" autofocus placeholder="Enter Class" value="{{ old('class') }}">
                        {!! $errors->first('class', '<span class="help-block">:message</span>') !!}
                    </div>
                    </div>
                    <input type="hidden" name="reportmaster_id" id="reportmaster-id">
                    <input type="hidden" name="old_name" id="old-name">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button class="btn btn-primary pull-left" id="btn-cancel-update">Cancel</button>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Master</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.reports.reportmaster.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('module_id') ? ' has-error has-feedback' : '' }}">
                        <label for="module_id">Module</label>
                        {!! $errors->first('module_id', '<span class="help-block">:message</span>') !!}
                        <select class="module dropdown" id="itemName" name="module_id">
                            <option></option>
                            @foreach($reportmodules as $reportmodule)
                                <option value="{{$reportmodule->id}}">
                                    {{$reportmodule->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{ $errors->has('query') ? ' has-error has-feedback' : '' }}">
                        <label for="query">Query</label>
                        <input type="text" class="form-control" id="query"  name = "query" autofocus placeholder="Enter Query" value="{{ old('query') }}">
                        {!! $errors->first('query', '<span class="help-block">:message</span>') !!}
                    </div>
                        <div class="form-group {{ $errors->has('export_format') ? ' has-error has-feedback' : '' }}">
                            <label for="export_format">Export Format</label>
                            <input type="text" class="form-control" id="export-format"  name = "export_format" autofocus placeholder="Enter Export Format" value="{{ old('export_format') }}">
                            {!! $errors->first('export_format', '<span class="help-block">:message</span>') !!}
                        </div>
                        </div>
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('orientation') ? ' has-error has-feedback' : '' }}">
                        <label for="orientation">Orientation</label>
                        <input type="text" class="form-control" id="orientation"  name = "orientation" autofocus placeholder="Enter Orientation" value="{{ old('orientation') }}">
                        {!! $errors->first('orientation', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('papersize') ? ' has-error has-feedback' : '' }}">
                        <label for="papersize">PaperSize</label>
                        <input type="text" class="form-control" id="papersize"  name = "papersize" autofocus placeholder="Enter PaperSize" value="{{ old('papersize') }}">
                        {!! $errors->first('papersize', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('type') ? ' has-error has-feedback' : '' }}">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type"  name = "type" autofocus placeholder="Enter Type" value="{{ old('type') }}">
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                        <div class="form-group {{ $errors->has('code') ? ' has-error has-feedback' : '' }}">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code"  name = "code" autofocus placeholder="Enter Code" value="{{ old('code') }}">
                            {!! $errors->first('code', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group {{ $errors->has('frequency') ? ' has-error has-feedback' : '' }}">
                        <label for="frequency">Frequency</label>
                        <input type="text" class="form-control" id="frequency"  name = "frequency" autofocus placeholder="Enter Frequency" value="{{ old('frequency') }}">
                        {!! $errors->first('frequency', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('is_mnth_gnrtn') ? ' has-error has-feedback' : '' }}">
                        <label for="is_mnth_gnrtn">Is Month Generation</label>
                        <div>
                            <input type="radio" name="is_mnth_gnrtn" value="1" checked>
                            <label>Yes</label>
                            <input type="radio" name="is_mnth_gnrtn" value="0">
                            <label>No</label>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('class') ? ' has-error has-feedback' : '' }}">
                        <label for="class">Class</label>
                        <input type="text" class="form-control" id="class"  name = "class" autofocus placeholder="Enter Class" value="{{ old('class') }}">
                        {!! $errors->first('class', '<span class="help-block">:message</span>') !!}
                    </div>
                        </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('reports::reportmasters.title.create reportmaster') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.reports.reportmaster.create') ?>" }
                ]
            });

        });
        $('.module').select2({
           width: '100%'
        });
    </script>
    <?php $locale = locale(); ?>
<script type="text/javascript">
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[ 0, "desc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
        $('#select-all').on('click', function(){
            // Check/uncheck all checkboxes in the table
            var rows = categoryTable.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#filetypedategory-table tbody').on('change', 'input[type="checkbox"]', function(){
            // If checkbox is not checked
            if(!this.checked){
                var el = $('#select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if(el && el.checked && ('indeterminate' in el)){
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });

        $(".category-edit-button").click(function () {

            $("#reportmaster-list").hide();

            $("#reportmaster-id").val($(this).data("id"));
            $("#old-name").val($(this).data("name"));
            $("#update-form").find('input[name="name"]').val($(this).data("name"));
            $("#update-form").find('input[name="query"]').val($(this).data("query"));
            $("#update-form").find('input[name="module_id"]').val($(this).data("module_id"));
            $("#update-form").find('input[name="orientation"]').val($(this).data("orientation"));
            $("#update-form").find('input[name="papersize"]').val($(this).data("papersize"));
            $("#update-form").find('input[name="type"]').val($(this).data("type"));
            $("#update-form").find('input[name="frequency"]').val($(this).data("frequency"));
            $("#update-form").find('input[type="radio"]').val($(this).data("is_mnth_gnrtn"));
            $("#update-form").find('input[name="class"]').val($(this).data("class"));
            $("#update-form").find('input[name="export_format"]').val($(this).data("export_format"));
            $("#update-form").find('input[name="code"]').val($(this).data("code"));
            $("#update-div").show();
        });

        $("#btn-cancel-update").click(function(event){
            event.preventDefault();
            $("#reportmaster-list").show();
            $("#update-div").hide();

        });
    });
</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Reports\Http\Requests\UpdateReportMasterRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Reports\Http\Requests\CreateReportMasterRequest','#create-form')->render() !!}
@endpush
