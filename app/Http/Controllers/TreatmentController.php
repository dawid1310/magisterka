<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function menu()
    {
        if (Auth::user()->account_type == "User") {
            return view('treatments/index');
        } else {
            return view('treatments/menu');
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->account_type == "User") {
            $treatments = DB::table('treatments')
                ->join('diseases', 'treatments.disease_id', '=', 'diseases.id')
                ->join('visits', 'visits.treatment_id', '=', 'treatments.id')
                ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
                ->join('users', 'doctors.user_id', '=', 'users.id')
                ->where('visits.user_id', '=', Auth::user()->id)
                ->select('treatments.id', 'users.name', 'users.surname', 'diseases.name as disease', 'treatments.status')
                ->distinct()
                ->get();

            $files = DB::table('files')
                ->join('treatments', 'files.treatment_id', '=', 'treatments.id')
                ->join('visits', 'visits.treatment_id', '=', 'treatments.id')
                ->where('visits.user_id', '=', Auth::user()->id)
                ->select('treatments.id', 'files.name', 'files.file_path', 'files.description')
                ->distinct()
                ->get();
            return view('treatments.index', ['treatments' => $treatments, 'files' => $files]);
        }
        if (Auth::user()->account_type == "Doctor") {
            $url = last(request()->segments());
            $status;
            if ($url == 'current') {
                $treatments = DB::table('treatments')
                    ->join('diseases', 'treatments.disease_id', '=', 'diseases.id')
                    ->join('visits', 'visits.treatment_id', '=', 'treatments.id')
                    ->join('users', 'visits.user_id', '=', 'users.id')
                    ->where('visits.doctor_id', '=', Cookie::get('docid'))
                    ->where('treatments.status', '=', 'Leczenie')
                    ->select('treatments.id', 'users.name', 'users.surname', 'diseases.name as disease')
                    ->distinct()
                    ->get();
                $status = "Leczenie w trakcie";
            } elseif ($url == 'history') {
                $treatments = DB::table('treatments')
                    ->join('diseases', 'treatments.disease_id', '=', 'diseases.id')
                    ->join('visits', 'visits.treatment_id', '=', 'treatments.id')
                    ->join('users', 'visits.user_id', '=', 'users.id')
                    ->where('visits.doctor_id', '=', Cookie::get('docid'))
                    ->where(function ($query) {
                        $query->where('treatments.status', '=', 'Zakonczony')
                            ->orWhere('treatments.status', '=', 'Wyleczony');
                    })
                    ->select('treatments.id', 'users.name', 'users.surname', 'diseases.name as disease')
                    ->distinct()
                    ->get();
                $status = "Przypadek zakończony";
            }

            return view('treatments.index', ['treatments' => $treatments, 'status' => $status]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dicid = $request->cookie('docid');
        $visits = DB::table('visits')
            ->join('users', 'visits.user_id', '=', 'users.id')
            ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
            ->where('visits.visit_type_id', '=', null)
            ->where('visits.doctor_id', '=', $dicid)
            ->select('users.name', 'users.surname', 'visits.patient_desc', 'visits.id', 'visits.day', 'visits.time', 'visits.user_id')
            ->get();
        $treatments = DB::table('treatments')
            ->join('diseases', 'treatments.disease_id', '=', 'diseases.id')
            ->join('visits', 'visits.treatment_id', '=', 'treatments.id')
            ->where('visits.doctor_id', '=', $dicid)
            ->where('treatments.status', '=', 'Leczenie')
            ->select('treatments.id', 'diseases.name', 'visits.user_id')
            ->get();
        //dd($treatments);
        //dd($treatments->contains('user_id', 4));
        return view('treatments.create', ['visits' => $visits, 'treatments' => $treatments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visit_type = [
            'r' => 1,
            'z' => 2,
            'k' => 3,
            't' => 4,
        ];
        if (request('isNew')) {
            $treatment = Treatment::create([
                'status' => 'Leczenie',
            ]);
            Visit::where('id', request('id'))
                ->update([
                    'visit_type_id' => 4,
                    'treatment_id' => $treatment->id,
                    'doctor_desc' => request('doctor_desc'),
                ]);
        } else {
            Visit::where('id', request('id'))
                ->update([
                    'visit_type_id' => $visit_type[request('visit_type')],
                    'treatment_id' => request('treatment_id'),
                    'doctor_desc' => request('doctor_desc'),
                ]);
        }
        return redirect('/treatment/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $treatment = DB::table('visits')
        ->where('visits.treatment_id', $id)
        ->select('visits.day', 'visits.time', 'visits.patient_desc', 'visits.doctor_desc')
        ->get();

        $user = DB::table('users')
        ->join('visits', 'visits.user_id', 'users.id')
        ->where('visits.treatment_id', $id)
        ->select('users.name', 'users.surname')
        ->first();

        $files = DB::table('files')
        ->where('treatment_id', $id)
        ->select('name', 'description', 'file_path')
        ->get();
        return view('treatments.show', ['treatment' => $treatment, 'user' => $user, 'files'=>$files]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
