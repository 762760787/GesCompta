@extends('layouts.apps')

@section('content')

    <div class="container-xxl">

        <div class="authentication-wrapper authentication-basic container-p-y">

            <div class="authentication-inner">

                <!-- Register Card -->

                <div class="card px-sm-6 px-0">

                    <div class="card-body">

                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('../assets/img/favicon/favicon.ico') }}" alt="Logo de KOSSI BAYE" style="max-width: 90px; max-height: 90px;">
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">MONIFY</span>
                            </a>
                        </div>

                        <!-- /Logo -->

                        <h4 class="mb-1">Créer un Compte </h4>

                        <form id="formAuthentication" class="mb-6" action="{{ route('register.store') }}"
                            method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="username" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control" id="username" name="name"
                                    placeholder="Enter your username" autofocus />

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" />

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base bx bx-hide"></i></span>
                                </div>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary d-grid w-100 mt-4">Créer le compte</button>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
