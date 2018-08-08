<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{$page_title}}</title>
    <link href="{{asset('public/css/all.css')}}" rel="stylesheet" type="text/css">
    @if($current_url == env('APP_URL').'admin/new-employee')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    @endif
</head>