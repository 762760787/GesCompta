@extends('layouts.apps')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo de KOSSI BAYE"
                                        style="max-width: 90px; max-height: 90px;">
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">KOSSI BAYE</span>
                            </a>
                        </div>

                        <h4 class="mb-1">Modifier le Compte 🚀😊</h4>

                        <form id="formEditUser" class="mb-6" action="{{ route('users.update', $user->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT') {{-- Indiquer qu'il s'agit d'une mise à jour --}}

                            <div class="mb-6">
                                <label for="username" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control" id="username" name="name"
                                    value="{{ $user->name }}" placeholder="Enter your username" autofocus />

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="Enter your email" />

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-password-toggle">
                                <label class="form-label" for="password">Nouveau Mot de Passe (laisser vide pour ne pas modifier)</label>
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

                            <button type="submit" class="btn btn-primary d-grid w-100 mt-4">Modifier le compte</button>
                        </form>

                    </div>

                    @endsection