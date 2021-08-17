<?php

namespace App\Http\Controllers;

use App\Models\Simulator;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listInstitutions(Request $request, Simulator $simulator)
    {
        return response()->json($simulator->institutions());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCovenants(Request $request, Simulator $simulator)
    {
        return response()->json($simulator->covenants());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listFeesInstitutions(Request $request, Simulator $simulator)
    {
        return response()->json($simulator->feesInstitutions());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simulate(Request $request, Simulator $simulator)
    {     
        $data = $request->toArray(); 
        //recebe e trata os inputs
        $loanValue = isset($data['valor_emprestimo'])? $simulator->brl2decimal($data['valor_emprestimo']) : 0;
        $institutions = $data['instituicoes']?? null;
        $covenents = $data['convenios']?? null;
        $quota = $data['parcela']?? null;
        //busca as taxas de instituições
        $fees = $simulator->feesInstitutions();
        //monta o resultado com o cálculo do empréstimo baseado no coeficiente
        foreach ($fees as $key => $value) {
          $result[$value->instituicao][] = [
            "taxa" => $value->taxaJuros,
            "parcelas" => $value->parcelas,          
            "valor_parcela" => $simulator->brl2decimal($value->coeficiente * $loanValue),
            "convenio" => $value->convenio,
          ];  
        }         
        return response()->json($result);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simulator  $simulator
     * @return \Illuminate\Http\Response
     */
    public function show(Simulator $simulator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simulator  $simulator
     * @return \Illuminate\Http\Response
     */
    public function edit(Simulator $simulator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simulator  $simulator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simulator $simulator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simulator  $simulator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simulator $simulator)
    {
        //
    }
}
