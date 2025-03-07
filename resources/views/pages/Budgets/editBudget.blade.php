@extends('layouts.apps')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-3 mb-6">
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">Modifier Un Budget</h5>
                        <div class="card-body">
                            <form action="{{ route('budgets.update', $budget->id) }}" method="POST" class="browser-default-validation">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $budget->id }}">

                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <label class="form-label" for="nom">Nouveau budget</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $budget->nom }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="datedebut">Date de debut</label>
                                    <input type="date" id="datedebut" name="datedebut" class="form-control" value="{{ $budget->datedebut }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="datedefin">Date de fin</label>
                                    <input type="date" id="datedefin" name="datedefin" class="form-control" value="{{ $budget->datedefin }}" required />
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="montant">Solde</label>
                                    <input type="text" class="form-control" id="montant" name="montant" value="{{ $budget->montant }}" required />
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection