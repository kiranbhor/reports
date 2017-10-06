    @extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('reports::reportlogs.title.reportlogs') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('reports::reportlogs.title.reportlogs') }}</li>
    </ol>
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    Generate Report
                </div>
                <div class="box-body">
                    {!!  Former::horizontal_open()
                     ->id('reportform')
                     ->route('admin.report.generate')
                     ->method('POST') !!}

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="report_Type" class="control-label col-lg-4 col-sm-4">
                                Report Type
                            </label>
                            <div class="col-lg-8 col-sm-8">
                                {!!
                                    Former::select('report_Type')
                                        ->fromQuery($reports,'name','id')
                                        ->select('1')
                                        ->raw()
                                !!}

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reportrange" class="control-label col-lg-4 col-sm-4">
                                Date
                            </label>
                            <div class="col-lg-8 col-sm-8">
                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>

                                <div style="display:none">
                                    {!! Former::text('start_date') !!}
                                    {!! Former::text('end_date') !!}
                                </div>
                            </div>
                        </div>

                        {!! Former::actions()
                            ->large_primary_submit('Generate')
                            ->large_inverse_reset('Reset')
                            ->addClass('col-lg-offset-4 col-sm-offset-4 col-lg-10 col-sm-8')
                            ->raw()
                         !!}

                    </div>

                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    Generated Reports
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($reportlogs)): ?>
                            <?php foreach ($reportlogs as $reportlog): ?>
                            <tr>
                                <td>
                                    <a href="{{ route('admin.reports.reportlog.edit', [$reportlog->id]) }}">
                                        {{ $reportlog->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.reports.reportlog.edit', [$reportlog->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.reports.reportlog.destroy', [$reportlog->id]) }}"><i class="fa fa-trash"></i></button>
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
        <dd>{{ trans('reports::reportlogs.title.create reportlog') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.reports.reportlog.create') ?>" }
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
        });

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);


    </script>
@endpush
