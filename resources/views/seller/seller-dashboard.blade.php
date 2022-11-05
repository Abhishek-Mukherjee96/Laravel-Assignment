<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="row">
        <div class="container">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg bg-danger">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{route('seller-dashboard')}}">Welcome {{Auth::user()->email}}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <!-- <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">View Profile</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('rate_chart')}}">Rate Chart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </nav>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">

            <div class="col-md-8 offset-2">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                <div class="card">
                    <div class="card-header bg-info">Profile</div>
                    <div class="card-body">
                        <label for="">Email: {{$seller_profile->email}}</label>
                        <hr>
                        <form action="{{url('profile-action/'.$seller_profile->id)}}" method="post" enctype="multipart/form-data">
                            <!-- <form action="{{url('profile-action/'.$seller_profile->id)}}" method="post" enctype="multipart/form-data"> -->
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                                @error('file')
                                <span class="text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Description</label>
                                <textarea name="desc" class="form-control"></textarea>
                                @error('desc')
                                <span class="text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>