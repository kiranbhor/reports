@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('reports::reportmodules.title.reportmodules') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('reports::reportmodules.title.reportmodules') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <div id="reportmodule-list" class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Order</th>
                                <th>CSS Class</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($reportmodules)): ?>
                            <?php foreach ($reportmodules as $reportmodule): ?>
                            <tr>
                                <td>{{$reportmodule->name}}</td>
                                <td>{{$reportmodule->order}}</td>
                                <td>{{$reportmodule->css_class}}</td>
                                <td>
                                    <a href="{{ route('admin.reports.reportmodule.edit', [$reportmodule->id]) }}">
                                        {{ $reportmodule->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-flat category-edit-button" data-name="{{$reportmodule->name}}" data-order="{{$reportmodule->order}}" data-css_class="{{$reportmodule->css_class}}" data-id="{{$reportmodule->id}}"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.reports.reportmodule.destroy', [$reportmodule->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
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
                    <h3 class="box-title">Update Report Module</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.reports.reportmodule.update'], 'method' => 'post','id'=>'update-form']) !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('order') ? ' has-error has-feedback' : '' }}">
                        <label for="name">Order</label>
                        <input type="text" class="form-control" id="order"  name = "order" autofocus placeholder="Enter Order" value="{{ old('order') }}">
                        {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('css_class') ? ' has-error has-feedback' : '' }}">
                        <label for="css_class">CSS Class</label>
                        <input type="text" class="form-control" id="css-class"  name = "css_class" autofocus placeholder="Enter CSS Class" value="{{ old('css_class') }}">
                        {!! $errors->first('css_class', '<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="reportmodule_id" id="reportmodule-id">
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
        <div class="col-xs-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Module</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                {!! Form::open(['route' => ['admin.reports.reportmodule.store'], 'method' => 'post','id'=>'create-form']) !!}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name"  name = "name" autofocus placeholder="Enter Name" value="{{ old('name') }}">
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('order') ? ' has-error has-feedback' : '' }}">
                        <label for="order">Order</label>
                        <input type="text" class="form-control" id="order"  name = "order" autofocus placeholder="Enter Order" value="{{ old('order') }}">
                        {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('css_class') ? ' has-error has-feedback' : '' }}">
                        <label for="css_class">CSS Class</label>
                        <input type="text" class="form-control" id="css-class"  name = "css_class" autofocus placeholder="Enter CSS Class" value="{{ old('css_class') }}">
                        {!! $errors->first('css_class', '<span class="help-block">:message</span>') !!}
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
        <dd>{{ trans('reports::reportmodules.title.create reportmodule') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.reports.reportmodule.create') ?>" }
                ]
            });
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

                $("#reportmodule-list").hide();

                $("#reportmodule-id").val($(this).data("id"));
                $("#old-name").val($(this).data("name"));
                $("#update-form").find('input[name="name"]').val($(this).data("name"));
                $("#update-form").find('input[name="order"]').val($(this).data("order"));
                $("#update-form").find('input[name="css_class"]').val($(this).data("css_class"));
                $("#update-div").show();
            });

            $("#btn-cancel-update").click(function(event){
                event.preventDefault();
                $("#reportmodule-list").show();
                $("#update-div").hide();

            });
        });
    </script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!!  JsValidator::formRequest('Modules\Reports\Http\Requests\UpdateReportModuleRequest','#update-form')->render() !!}
{!!  JsValidator::formRequest('Modules\Reports\Http\Requests\CreateReportModuleRequest','#create-form')->render() !!}
@endpush
