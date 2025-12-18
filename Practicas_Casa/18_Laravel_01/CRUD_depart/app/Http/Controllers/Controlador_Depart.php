<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depart;

class Controlador_Depart extends Controller
{
    public function index()
    {
        $departs = Depart::all();

        return view("Depart.index", ["departs" => $departs]);
    }
    public function create()
    {
        return view("Depart.form");
    }
    public function store(Request $request)
    {
        $depart_no = $request->input("depart_no");
        $dnombre = $request->input("dnombre");
        $loc = $request->input("loc");

        Depart::create([
            "depart_no" => $depart_no,
            "dnombre" => $dnombre,
            "loc" => $loc,
        ]);

        return redirect("/departs");
    }

    public function show() {}


    public function edit($id)
    {
        $depart = Depart::find($id);

        //return view("Depart.formUpdate",["depart" => $depart]);
        return view("Depart.formUpdate", compact("depart"));
    }
    public function update(Request $request, $id)
    {

        $dnombre = $request->input("dnombre");
        $loc = $request->input("loc");

        $depart = Depart::find($id);

        $depart->update([
            'dnombre'   => $dnombre,
            'loc'       => $loc,
        ]);

        return redirect("/departs");
    }


    public function destroy($id)
    {
        try {
            Depart::destroy($id);
        } catch (\Exception $e) {
            return redirect()->route("departs.index")->with('error', 'No se puede eliminar el empleado.') ;
        }
        return redirect()->route("departs.index")->with('sucess', 'No se puede eliminar el empleado.') ;
    }
}
