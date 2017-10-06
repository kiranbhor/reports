<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
                @setting('core::site-name') | Admin
            @show
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">

        <style type="text/css">
            @page { margin: 100px 25px; }
            header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
            footer { position: fixed; bottom: -60px; left: 0px; right: 0px;  height: 50px; }
            p { page-break-after: always; }
            p:last-child { page-break-after: never; }

            .report-title{
                text-align: center;
                font-size: large;
            }

            .report-subtitle{
                text-align: center;
                font-size: small;
            }

            .report-subfooter{
                text-align: center;
                font-size: small;
            }

            .report-footer{
                text-align: center;
                font-size: large;
            }

            th{
                background-color: darkgray;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;

            }

            th,td{
                padding-left: 5px;
            }

            table {
                width:100%;

            }




        </style>

        @section('styles')
        @show

    </head>
    <body >

        <header>
            @section('header')
            @show
            @include('reports::reports.layout.header')
        </header>

        <footer>
            @section('footer')
            @show
            @include('reports::reports.layout.footer')

        </footer>

        @yield('content')
        @show

    </body>
</html>
