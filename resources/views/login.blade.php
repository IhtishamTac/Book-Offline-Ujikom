<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <div class="col-5 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h2>Login</h2>
                    <form action="{{ route('postlogin') }}" class="form-group" method="POST">
                        @csrf
                        <div class="mt-3">
                            <input type="text" placeholder="Username..." name="username" class="form-control">
                        </div>
                        <div class="mt-3">
                            <input type="password" name="password" placeholder="Password..." class="form-control">
                        </div>
                        <div class="mt-3">
                            <button class="btn w-100 text-white" style="background-color: rgb(0, 68, 255); border-radius: 2px;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
