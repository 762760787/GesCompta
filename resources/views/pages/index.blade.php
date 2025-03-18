@extends('layouts.apps')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-xxl-12 mb-6 order-0 ">
                    <div class="card col-md-12">
                        <div class="d-flex align-items-start row">
                            <div class="col-sm-7">
                                <div class="card-body ">
                                    <h5 class="card-title text-primary mb-3">Bienvenue sur MONIFY {{ Auth::user()->name }} ! </h5>
                                    <p class="mb-6"> Ici, vous pouvez gérer vos finances en toute simplicité et efficacité.
                                        .<br />Explorez les fonctionnalités offertes, telles que la gestion des
                                        transactions, le suivi des comptes et bien plus encore.</p>

                                    {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">Espace de gestion financière</a> --}}
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-6">
                                    <img src="{{ asset('../assets/img/illustrations/man-with-laptop.png') }}" height="175"
                                        alt="View Badge User" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-xxl-6 col-lg-12 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                            </button>
                                            
                                        </div>
                                    </div>
                                    <p class="mb-1">Solde initial</p>
                                    <h4 class="card-title mb-3">{{ $budgetInitial }} FCFA</h4>
                                    <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i>
                                        </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="wallet info"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                            </button>
                                            
                                        </div>
                                    </div>
                                    <p class="mb-1">Dépense Totales</p>
                                    <h4 class="card-title mb-3">{{ $totalDepenses }} FCFA</h4>
                                    <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i>
                                        {{ $pourcentageDepenses }}%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue -->

                <!--/ Total Revenue -->
                <div class="col-12 col-md-4 col-lg-12 col-xxl-6 order-2 order-md-2 profile-report">
                    <div class="row">
                        <div class="col-6 mb-6 payments">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="paypal"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="javascript:void(0);">View
                                                    More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1">Solde provisoire </p>
                                    <h4 class="card-title mb-3">{{ $budgetprovisoir }} FCFA</h4>
                                    <small class="text-success fw-medium"><i class="icon-base bx bx-down-arrow-alt"></i>
                                        </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-6 transactions">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
                                            </button>
                                           
                                        </div>
                                    </div>
                                    <p class="mb-1">Solde Actuel</p>
                                    <h4 class="card-title mb-3">{{ $soldeActuel }} FCFA</h4>
                                    <small class="text-success fw-medium"><i class="icon-base bx bx-up-arrow-alt"></i>
                                        </small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Order Statistics -->

                <!--/ Order Statistics -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-6 order-2 mb-6">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2 btn btn-success">Revenu net disponible {{ number_format($totalRevenus, 2) }} FCFA</h5>
                            <div class="dropdown">
                                <button class="btn text-body-secondary p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body pt-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Objectif</th>
                                        <th>Gagné</th>
                                        <th>Reste à Atteindre</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoriesRevenu as $categorie)
                                        <tr>
                                            <td>{{ $categorie->description }}</td>
                                           
                                            <td>{{ $categorie->budgetTotal }} FCFA</td>
                                            <td>{{ $categorie->budgetReel }} FCFA</td>
                                            <td>{{$categorie->budgetRestant }} FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!--/ Transactions -->

                <!-- pill table -->
                <div class="col-md-6 order-3 order-lg-4 mb-6 mb-lg-0">
                    <div class="card text-center h-100">
                        <div class="card-header nav-align-top">
                            <ul class="nav nav-pills flex-wrap row-gap-2" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser"
                                        aria-selected="true">Total des Dépenses {{ $totalDepenses }} FCFA</button>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content pt-0 pb-4">
                            <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                                <div class="table-responsive text-start text-nowrap">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Budget Prévu</th>
                                                <th>Budget Dépensé</th>
                                                <th>Budget Restant</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categoriesDepense as $categorie)
                                                <tr>
                                                    <td>{{ $categorie->description }}</td>
                                                    <td>{{ $categorie->budgetPrevus }}</td>
                                                    <td>{{ $categorie->budgetDepense }}</td>
                                                    <td>{{ $categorie->budgetRestant }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--/ pill table -->
            </div>

        </div>
        <!-- / Content -->


    </div>
    <!-- Content wrapper -->
@endsection
