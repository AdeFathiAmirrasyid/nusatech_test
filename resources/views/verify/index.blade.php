@extends('index')

@section('container')
    <div class="alert alert-danger mb-n3 text-center" role="alert">
        Anda Belum Verifikasi email, <a href="/email/verify/resend-verification">verifikasi ulang</a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mt-5 row justify-content-center">
        <div class="col-lg-5">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center">Mohon untuk melanjutkan verifikasi email terlebih dahulu</h1>
            </main>
        </div>
    </div>
@endsection
