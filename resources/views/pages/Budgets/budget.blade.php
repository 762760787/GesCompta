@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-6">
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Ajouter Un Compte</h5>
                        <div class="card-body">
                            <form action="{{ route('budgets.store') }}" method="POST" class="browser-default-validation">
                                @csrf

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <label class="form-label" for="nom">Nouveau budget</label>
                                    <input type="text" class="form-control" id="nom" name="nom"
                                        value="{{ old('nom') }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="datedebut">Date de debut</label>
                                    <input type="date" id="datedebut" name="datedebut" class="form-control"
                                        value="{{ old('datedebut') }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="datedefin">Date de fin</label>
                                    <input type="date" id="datedefin" name="datedefin" class="form-control"
                                        value="{{ old('datedefin') }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="montant">Solde</label>
                                    <input type="text" class="form-control" id="montant" name="montant"
                                        value="{{ old('montant') }}" required />
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <h5 class="card-header">Tous mes Budgets</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <caption class="ms-6">
                                    List of Projects
                                </caption>
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Date début</th>
                                        <th>Date de fin</th>
                                        <th>Solde</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($budgets as $budget)
                                        <tr>
                                            <td><i class="icon-base fab fa-vuejs icon-md text-success me-4"></i> <span>
                                                    {{ $budget->nom }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($budget->datedebut)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($budget->datedefin)->format('d/m/Y') }}</td>
                                            <td><span class="badge bg-label-info me-1">{{ $budget->montant }}</span></td>
                                            <td><span class="">{{ $budget->statut }}</span></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('budgets.edit',$budget->id) }}"><i
                                                                class="icon-base bx bx-edit-alt me-1"></i> Edit</a>


                                                        <form action="{{ route('budgets.destroy', $budget->id) }}"
                                                            method="POST" class="dropdown-item">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="icon-base bx bx-trash me-1"></i>Supprimer</button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Aucun budget trouvé.</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
