@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <button id="btn_capture">Capture</button>

    <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript"
    src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    
    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
   
@stop
@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
<script>
    jQuery('#btn_capture').click(function(){
        jQuery('#btn_capture').hide();
        const t=document.body;
        html2canvas(t).then(
            canvas=>{
                document.body.appendChild(canvas);
                url_data=canvas.toDataURL();
                jQuery.ajax({
                    url:'{{route('process.store')}}',
                    // type:'post',
                    type:'post',
                    data:{
                        img:url_data
                    },
                    dataType:"html",
                    success:function(result){
                        console.log(result);
                        jQuery('#btn_capture').show();
                    }
                });	
        });
    });
        //console.log(t);
    </script>