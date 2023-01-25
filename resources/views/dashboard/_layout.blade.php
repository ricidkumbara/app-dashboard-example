<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard</title>
  <link rel="shortcut icon" href="{{ asset('images/splash.png') }}"/>
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('asset-ops/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <noscript>
    <H1 align = 'center'>This page needs JavaScript activated to work.</H1>
    <style>nav { display:none; } div { display:none; }</style>
  </noscript>

  <script>
    window.Laravel = <?php echo json_encode([
      'csrfToken' => csrf_token(),
    ]); ?>
  </script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition {{ config('app.skin', 'skin-blue') }} layout-top-nav">
<div class="wrapper"> 
  @yield('content')
</div> 

<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.fixedColumns.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
  $('.select2').select2(); 
</script>
@yield('scripts')
</body>
</html>