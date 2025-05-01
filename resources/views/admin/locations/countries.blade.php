@extends('admin.mainComponents')

@section('title', 'Countries')

@section('content')
@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@elseif (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
<div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow" style="background-color: #fff;">
                    <div class="card-header text-white py-2" style="background: #88304e;">
                        <h4 class="my-0">All Countries</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Country Name</th>
                                    <th>Number of Zones</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example country row, replace with dynamic content -->
                                @foreach($countries as $country)
                                <tr>
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->zones_count }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
<div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow" style="background-color: #fff;">
                    <div class="card-header text-white font-weight-bold py-2" style="background: #88304e;">
                        <h4 class="my-0">Add Country</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.addCountry') }}" method="POST">
                            @csrf
                            <!-- Country Name -->
                            <div class="mb-3">
                                <label for="country_name" style="font-weight: 600; font-size: 18px" class="form-label">Country Name</label>
                                <input type="text" class="form-control" id="country_name" name="name" placeholder="Enter country name" required>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn text-white" style="background: #88304e;">Add Country</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endSection
