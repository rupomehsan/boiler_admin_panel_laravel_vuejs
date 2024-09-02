@extends('layouts.app')

@section('content')
    <div id="toasterMessage">
        <p id="showMessage"></p>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <div id="errorMsgShow"></div>
                        <form onsubmit="submitHandler()">
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email">
                                    <p class="text-danger" id="email"></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" autocomplete="new-password">

                                    <p class="text-danger" id="password"></p>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class=" btn btn-outline-success" type="submit" id="spiner">
                                        <span>Log In</span>
                                        <span class="spinner-border spinner-border-sm d-none mx-2" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <script>
                            function submitHandler() {
                                event.preventDefault()

                                let spiner = document.getElementById('spiner')
                                loadHandler(spiner, response = false)

                                //  spiner.classList.remove('d-none')
                                fetch('login', {
                                        method: "POST",
                                        body: new FormData(event.target),
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                        }
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.status === 'validation_error') {
                                            loadHandler(spiner, response = true)
                                            let error = data.errors
                                            Object.entries(error).forEach(([key, value]) => {
                                                let field = document.getElementById(key)
                                                if (field) {
                                                    field.innerText = value
                                                }
                                            });
                                        } else if (data.status === 'error') {
                                            loadHandler(spiner, response = true)
                                            let target = document.getElementById('errorMsgShow')
                                            target.innerHTML = `
                                                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
                                                    <strong>Error! ${data.message}</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" onclick="document.getElementById('errorMsgShow').classList.add('d-none')">&times;</span>
                                                    </button>
                                                </div>
                                                `;
                                            target.classList.remove('d-none');
                                        } else {
                                            localStorage.setItem('token', data.access_token);
                                            window.location.href = 'admin#/dashboard';
                                        }

                                    })
                            }

                            function loadHandler(target, response) {
                                if (response) {
                                    target.removeAttribute('disabled')
                                    target.children[0].classList.remove('d-none')
                                    target.children[1].classList.add('d-none')
                                    target.children[2].classList.add('visually-hidden')
                                } else {
                                    target.setAttribute('disabled', true)
                                    target.children[0].classList.add('d-none')
                                    target.children[1].classList.remove('d-none')
                                    target.children[2].classList.remove('visually-hidden')
                                }

                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
