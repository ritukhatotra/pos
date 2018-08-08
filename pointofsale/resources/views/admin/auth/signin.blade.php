<!doctype html>
<html>
@include('common.head')
<body class="nav-md that-computer-guy">
<div class="login-page">
    <div class="middle-content">
        <div class="login-form">
            @if(session('err_msg'))
                <div class="alert alert-danger">
                    <?php echo session('err_msg'); ?>
                </div>
            @endif
            <h4>Please login to your account.</h4>
            <form id="login-form" action="{{url('admin/signin')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" value="" class="form-control" autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" value="" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="full-width">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('public/js/all.js')}}"></script>
<script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/js/admin/common.js')}}"></script>
</body>
</html>

