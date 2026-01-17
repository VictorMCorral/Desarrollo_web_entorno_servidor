@extends("layouts_prieto.home")

@section("content")
<div class="form-signin w-25 m-auto">

    <form method="POST" action="{{ route('register_prieto') }}">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Registrarse</h1>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Nombre" value="{{ old('name') }}">
            <label for="floatingInput">Nombre</label>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">Email address</label>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password">
            <label for="floatingPassword">Password</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            <label for="floatingPassword">Confirm Password</label>
        </div>

        <button class="btn btn-success w-100 py-2" type="submit">Registrarse</button>

        <p class="mt-5 mb-3 text-body-secondary text-center">© 2017–2025</p>
    </form>
</div>
@endsection