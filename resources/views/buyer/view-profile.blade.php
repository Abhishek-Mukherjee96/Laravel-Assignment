<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Chart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="row">
        <div class="container">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg bg-danger">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{route('buyer-dashboard')}}">Welcome {{Auth::user()->email}}</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
            <div class="col-md-6">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                <div class="card">
                    <div class="card-header bg-info">Seller Profile Details</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Email: {{$view_seller_profile->email}}</label>
                        </div> 
                        <div class="form-group mb-3">
                            <label>Image: <img src="{{asset('uploads/'.$view_seller_profile->image)}}" width="75px" alt=""></label>
                        </div> 
                        <div class="form-group mb-3">
                            <label>Description: {{$view_seller_profile->desc}}</label>
                        </div>  
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">Rate Chart List</div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Orange Type</th>
                                    <th>Weight</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($seller_rate_list))
                                @foreach($seller_rate_list as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$list->orange_type}}</td>
                                    <td>{{$list->weight}}Kgs</td>
                                    <td>₹ {{$list->rate}}/-</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>