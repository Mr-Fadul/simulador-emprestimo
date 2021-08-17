<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Simulator extends Model
{
    use HasFactory;


    public function institutions()
    {
        $json = Storage::disk('local')->get('json/instituicoes.json');           
        $data = json_decode($json);
        return $data;
    }

    public function covenants()
    {
        $json = Storage::disk('local')->get('json/convenios.json');           
        $data = json_decode($json);
        return $data;
    }

    public function feesInstitutions()
    {
        $json = Storage::disk('local')->get('json/taxas_instituicoes.json');           
        $data = json_decode($json);
        return $data;
    }

    /**
     * formatar valor decimal universal
     * pode receber formato BRL ou USD e retorna decimal
     */
    public function brl2decimal($brl, $casasDecimais = 2) {
        // Se já estiver no formato USD, retorna como float e formatado
        if(preg_match('/^\d+\.{1}\d+$/', $brl))
            return (float) number_format($brl, $casasDecimais, '.', '');
        // Tira tudo que não for número, ponto ou vírgula
        $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
        // Tira o ponto
        $decimal = str_replace('.', '', $brl);
        // Troca a vírgula por ponto
        $decimal = str_replace(',', '.', $decimal);
        return (float) number_format($decimal, $casasDecimais, '.', '');
    }
}
