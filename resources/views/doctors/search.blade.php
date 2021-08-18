@extends('layout')
@section('css')
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 50%;
            border-radius: 5px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        img {
            border-radius: 5px 5px 0 0;
        }

        .container {
            padding: 2px 16px;
        }

    </style>
@endsection
@section('content')
    @foreach ($doctors as $doctor)
        <div style="width:50%">
            <a href="/doctors/{{ $doctor->id }}">
                <div class="card">
                    <img src="./assets/img/doctor.jpg" alt="Avatar" style="width:100%">
                    <div class="container">
                        <h3><b>{{ $doctor->name }} {{ $doctor->surname }} - {{ $doctor->specialization }}</b></h3>
                        <p>{{ $doctor->informations }}</p>
                    </div>
                </div>
            </a>
        </div>

    @endforeach
@endsection
