<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Seguranca extends Controller
{
    public function criptPadrao(string $dados){
        $dados = base64_encode($dados);
        $dados = base64_encode($dados);
        $dados = base64_encode($dados);
        $dados = base64_encode($dados);
        return $dados;
    }

    public function descriptPadrao(string $dados){
        $dados = base64_decode($dados);
        $dados = base64_decode($dados);
        $dados = base64_decode($dados);
        $dados = base64_decode($dados);
        return $dados;
    }
    function verificaRequest($dados, $criptografar, $maiusculo){
        $dados = trim(addslashes($dados));
        if ($dados != null || $dados != '') {
            if ($criptografar){
                $dados = $this->criptPadrao($dados);
            }
            if ($maiusculo){
                $dados = mb_strtoupper($dados, 'UTF-8');
            }
            return $dados;
        }else
            return null;
    }
}
