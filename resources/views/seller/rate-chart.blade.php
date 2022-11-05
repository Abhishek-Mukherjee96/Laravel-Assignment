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
            <div class="col-md-6">
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                <div class="card">
                    <div class="card-header bg-info">Add Rate Chart</div>
                    <div class="card-body">
                        <form action="{{url('rate-chart-action/'.$seller_profile->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="mb-3">Orange Type</label>
                                <select name="orange_type" class="form-control">
                                    <option value="">---Select Type---</option>
                                    <option value="Normal Orange">Normal Orange</option>
                                    <option value="Good Orange">Good Orange</option>
                                </select>
                                @error('orange_type')
                                <span class="text text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-3">Weight</label>
                                        <input type="text" name="weight" class="form-control" placeholder="Weight">
                                        @error('weight')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="mb-3">Rate</label>
                                        <input type="text" name="rate" class="form-control" placeholder="Rate">
                                        @error('rate')
                                        <span class="text text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($rate_chart))
                                @foreach($rate_chart as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$list->orange_type}}</td>
                                    <td>{{$list->weight}}Kgs</td>
                                    <td>₹ {{$list->rate}}/-</td>
                                    <td>
                                        <a href="{{route('edit_rate_chart', $list->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
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