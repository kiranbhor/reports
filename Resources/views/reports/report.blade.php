@extends('reports::reports.layout.master')

@section('styles')

@endsection

@section('content')
    <table>
        <tr>
            @foreach($report->columns as $column)
                <th style="{{isset($column['header_style'])?$column['header_style']:''}}">
                    {{isset($column['display_name'])?$column['display_name']:''}}
                </th>
            @endforeach
        </tr>
        <?php
            $i = 0;
        ?>
        @foreach($report->data as $row)
            <?php $i++;
            ?>
            <tr>
            @foreach($report->columns as $column)
                <td style="{{isset($column['row_style'])?$column['row_style']:''}}">

                    <?php $value;

                        if(isset($column['force_value'])){
                            $value = $column['force_value'];
                        }
                        else if(isset($column['type'])){
                            if($column['type'] === REPORT_ROWNO_COLUMN){
                                $value = $i;
                            }
                            else if($column['type'] === REPORT_RELATION_COLUMN){
                                if(isset($column['function'])){
                                    $value = $column['function']($row->{$column['column_name']},$column['relation_column']);
                                }
                                else{
                                    $value = isset($row->{$column['column_name']})?$row->{$column['column_name']}->{$column['relation_column']}:'';
                                }


                            }

                        }
                        else if(isset($column['function'])){
                            $value = $column['function']($row->{$column['column_name']},$column['column_name']);
                        }
                        else{
                            $value = $row->{$column['column_name']};
                        }

                        if(isset($column['format'])){
                            $value = formatValue($value,$column['format']);
                        }

                        if(!isset($value)){
                            if(isset($column['default_value'])){
                                $value = $column['default_value'];
                            }
                            else{
                                $value = "-";
                            }
                        }
                    ?>


                    {{$value}}

                </td>
            @endforeach
            </tr>
        @endforeach
    </table>
@endsection
