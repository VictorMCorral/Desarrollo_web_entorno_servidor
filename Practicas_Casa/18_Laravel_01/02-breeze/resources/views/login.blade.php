@extends("layouts_prieto.home")

@section("content")
<div class="form-signin w-25 m-auto">

    <form method="POST" action="{{ route('login_prieto') }}">
        @csrf
        <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-floating mb-3">
            <input type="email" id="floatingInput" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">Email address</label>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" id="floatingPassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <label for="floatingPassword">Password</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

        <p class="mt-5 mb-3 text-body-secondary text-center">© 2017–2025</p>
    </form>
</div>
@endsection