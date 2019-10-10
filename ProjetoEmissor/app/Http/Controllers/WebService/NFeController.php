<?php

namespace App\Http\Controllers\WebService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NfeServices;

class NFeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return 'teste';
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
        $nfe_service = new NfeServices([
            "atualizacao" => "2015-10-02 06:01:21",
            "tpAmb" => 2,
            "razaosocial" => "NEURIVALDA ALVES DA S ALMEIDA EIRELI",
            "siglaUF" => "TO",
            "cnpj" => "27448296000164",
            "schemes" => "PL_008i2",
            "versao" => "4.00",
            "tokenIBPT" => "AAAAAAA",
            "CSC" => "GPB0JBWLUR6HWFTVEAS6RJ69GPCROFPBBB8G",
            "CSCid" => "000001"
        ]);
        header("Content-Type: text/xml; charset=utf-8");
       // gera xml
        $xml =  $nfe_service->GerarNfe();
      // assina xml
       $assina_xml = $nfe_service->assinar($xml);

       return $assina_xml;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
