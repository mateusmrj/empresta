<?php

namespace App\Business;

use Illuminate\Support\Collection;
use App\Collections\InstituicaoCollection;
use App\Collections\TaxasCollection;

class SimuladorBusiness
{
    private $defaultInstituicoes;
     
    public function __construct()
    {
       $this->defaultInstituicoes = ["BMG","PAN", "OLE"];
    }

    public function getSimulacao(array $dados)
    {
        //dd($dados);
        $collecction  = new TaxasCollection();
        $taxas = $collecction->getTaxasCollection();

        $collecctionInstituicao  = new InstituicaoCollection();
        $institucoes = $collecctionInstituicao->getInstituicaoCollection();
       
        $dados['instituicoes'] = $dados['instituicoes'] ?? $this->defaultInstituicoes;
        $ranges  = $this->normalizaRanges($institucoes, $dados['instituicoes']);

        if(isset($dados['parcela']) && $dados['parcela']){
            $taxas = $this->normalizeParcelas($taxas, $dados);
         }

        if(isset($dados['convenios']) && $dados['convenios']){
           $taxas = $this->normalizeConvenios($taxas, $dados);
        }

        $simulacao = $this->buscaDados($taxas, $ranges, $dados);

        return $simulacao;
    }

    private function normalizeParcelas($taxas, $dados)
    {

        $taxas = array_filter($taxas->toArray(), function($produto) use ($dados) {
            return $produto['parcelas'] == $dados['parcela'];
        });

        return Collection::make($taxas);
    }

    private function normalizeConvenios($taxas, $dados)
    {

        $taxas = array_filter($taxas->toArray(), function($produto) use ($dados) {
            return in_array($produto['convenio'],$dados['convenios']);
        });

        return Collection::make($taxas);

       /* if(isset($dados['convenios']) && $dados['convenios']){
            
            $simulacao->map(function (&$instituicoes) use (&$filter, $dados) {
                
                $instituicoes = array_filter($instituicoes, function($produto) use ($dados) {
                    //dd($produto);
                    return in_array($produto['convenio'],$dados['convenios']);
                });
            });
        
            dd($taxas);
        }*/
    }

    private function buscaDados(Collection $taxas, array $ranges, array $dados)
    {
        $taxas->map(function ($taxa) use (&$ranges, $dados) {            
            foreach ($ranges as $key => &$array) {
                if($taxa['instituicao'] == $key){
                    $valor_parcela = number_format($dados['valor_emprestimo'] * $taxa['coeficiente'], 2);

                    $ranges[$key][] = [
                        'taxas'   => $taxa['taxaJuros'],
                        'parcelas'  => $taxa['parcelas'],
                        'valor_parcela'   => $valor_parcela,
                        'convenio'      => $taxa['convenio'],
                    ];
                    break;
                }

            }
            /*foreach($ranges as $k => $v){
                dd($ranges["PAN"],sizeof($ranges["PAN"]), $k);
                if(sizeof($ranges[$k]) == 0){
                    unset($ranges[$k]);
                }
            }*/
        });

        return Collection::make($ranges);
    }

    private function normalizaRanges(Collection $instituicoes, array $filterInsituicao)
    {
        $intituicaoRanges = [];
        $ranges = $instituicoes->whereIn('chave',$filterInsituicao);

        $ranges->map(function ($instituicao) use (&$intituicaoRanges) {
            foreach($instituicao as $key => $value){
                if($key == "chave"){
                    $intituicaoRanges[$value] = [];
                }
            }
        });

        return $intituicaoRanges;
    }
}