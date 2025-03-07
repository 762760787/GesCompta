@extends('layouts.apps')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-md-6 order-3 order-lg-4 mb-6 mb-lg-0">
                <div class="card text-center h-100">
                    <div class="card-header nav-align-top">
                        <ul class="nav nav-pills flex-wrap row-gap-2" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser"
                                    aria-selected="true">Total des Dépenses</button>
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
                                            <th>Budget dépensé</th>
                                            <th>Budget prévu</th>
                                            <th>Restant</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Transport</td>

                                            <td class="text-heading">8.92k</td>

                                            <td class="text-heading">8.92k</td>
                                            <td>
                                                <div class="d-flex justify-content-between align-items-center gap-4">
                                                    <div class="progress w-100" style="height:10px;">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 64.75%" aria-valuenow="64.75" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                    <small class="fw-medium">64.75%</small>
                                                </div>
                                            </td>
                                        </tr>

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
