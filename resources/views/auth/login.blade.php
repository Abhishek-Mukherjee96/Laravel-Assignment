<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="row mt-5">
        <div class="container">
            <div class="col-md-6 offset-3">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Login Form
                            <a href="{{url('/')}}" class="btn btn-info float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('login_form_action')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" value="{{old('email')}}" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    @error('email')
                                    <span class="text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password">
                                    </div>
                                    @error('password')
                                    <span class="text text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <input type="submit" value="Signin" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>