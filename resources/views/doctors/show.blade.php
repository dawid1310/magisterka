@extends('layout')
@section('name')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap');
        $background: #fffffb;
        $accent: #ff6b6c;
        $otherAccent: #ffc145;
        $darkBackground: #5b5f97;


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Roboto", arial, sans-serif;
            color: #222
        }

        #login-container {
            height: 400px;
            width: 350px;
            padding: 20px;
            border-radius: 5px;
            background: $background;
            position: relative;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);

            .profile-img {
                height: 100px;
                width: 100px;
                background: url('https://images.unsplash.com/photo-1504933350103-e840ede978d4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=564&q=80');
                background-size: cover;
                background-position: center;
                position: absolute;
                top: -25px;
                left: -25px;
                border-radius: 50%;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
            }

            h1 {
                font-family: 'Sriracha', arial, sans-serif;
                text-align: center;
                margin-bottom: 20px;
                color: $otherAccent;
            }

            .description {
                margin-bottom: 20px;
            }

            .social {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: calc(100% - 40px);
                margin: 0 auto;

                a {
                    text-align: center;
                    border: solid 2px $accent;
                    width: 75px;
                    padding: 5px 0;
                    border-radius: 5px;

                    &:hover {
                        background: $accent;
                        color: white;
                        cursor: pointer;
                    }
                }
            }

            button {
                width: 80%;
                height: 80px;
                font-size: 2rem;
                margin: 30px 10% 0 10%;
                color: $background;
                border: none;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
                border-radius: 5px;
                background: linear-gradient(45deg, $accent, $otherAccent, $otherAccent, $accent);
                background-size: 300% 300%;
                outline: none;
                transition: all 200ms ease-in-out;

                &:hover {
                    box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5);
                    transform: translateY(2px);
                    -webkit-animation: gradientBG 1.5s ease-in-out forwards;
                    animation: gradientBG 1.5s ease-in-out forwards;
                    cursor: pointer;
                }

                &:active {
                    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.5);
                    transform: translateY(4px);
                }
            }

            footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: $darkBackground;
                color: white;
                width: 100%;
                position: absolute;
                bottom: 0;
                height: 30px;
                padding: 0 20px;
                margin-left: -20px;
                border-bottom-left-radius: 5px;
                border-bottom-right-radius: 5px;

                div {
                    display: flex;

                    .fa-heart {
                        color: $accent;
                    }

                    p:first-child {
                        margin-right: 10px;
                        border-right: 4px solid white;
                        padding-right: 10px;
                    }
                }
            }
        }

        @-webkit-keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }

            // 100% {
            //   background-position: 0% 50%;
            // }
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }

            // 100% {
            //   background-position: 0% 50%;
            // }
        }

    </style>
@endsection
@section('content')
<section style="background-color: #03acfa !important;">
    <div class="container py-5">
        <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-2 col-12 text-light align-items-center">
                <i class='display-1 bi bi-calendar-check-fill'></i>
            </div>
            <div class="col-lg-7 col-12 text-light pt-2">
                <h3 class="h4 light-300">Wybierz date wizyty u lek. {{ $doctor->name }} {{ $doctor->surname }}</h3>
                <p class="light-300">Quis ipsum suspendisse ultrices gravida.</p>
            </div>
            <div class="col-lg-2 col-12 text-light align-items-center">
                <i class='display-1 bi bi-calendar-check-fill'></i>
            </div>
        </div>
    </div>
</section>
    <div class='col-xl-8 col-md-10 col-sm-12 mx-auto'>
            <div class="card mx-auto mt-4">
                <img src="{{ asset('/assets/img/doctor.jpg') }}" alt="Avatar" style="width:30%" class="mx-auto">
                <div class="container">
                    <h4 class="text-center"><b>{{ $doctor->name }} {{ $doctor->surname }}</b></h4>
                    <h6>Specjalizacja: {{ $doctor->specialization }}, {{ $doctor->specification }}</h6>
                    <p>{{ $doctor->informations }}</p>
                </div>
            </div>
            

            @foreach ($visits as $day)
            <div class="row ">
                
                <h6 class="pt-3">Data {{ $day['date'] }}:</h6>
         
                @foreach ($day['visits'] as $visit)
                    @if (!$visit['occupied'])
                    <div class="col-xl-1 col-md-2 col-sm-4 col-6  text-center">
                        <form action="/visit/create" method="post">
                            @csrf
                            <input type="hidden" name="doctor" value={{$doctor->id}}>
                            <input type="hidden" name="day" value={{$day['date']}}>
                            <input type="hidden" name="time" value={{$visit['time']}}>
                            <button type="submit" class="btn btn-primary mb-1">{{$visit['time']}}</button>
                        </form>
                    </div>
                    @endif
                @endforeach
            </div>
            @endforeach
            

    </div>

@endsection
