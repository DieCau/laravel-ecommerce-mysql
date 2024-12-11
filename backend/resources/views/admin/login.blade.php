{{-- Aqui va la view Login --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 mx-auto">
                @session('error')
                    <div class="alert alert-danger my-2">
                        {{ session('error') }}
                    </div>
                @endsession
                <div class="card shadow-sm p-5">
                    
                    <div class="card-header bg-white text-center">
                        <h3 class="mt-2">LOGIN</h3>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('admin.auth') }}" method="POST">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                id="floatingInput" placeholder="nombre@gmail.com">
                                <label for="floatingInput">Email</label>
                                
                                {{-- Aqui mensaje de error para Email --}}
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                id="floatingPassword" placeholder="Tu Password">
                                <label for="floatingPassword">Password</label>

                                {{-- Aqui mensaje de error para Password --}}
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Iniciar Sesion
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
