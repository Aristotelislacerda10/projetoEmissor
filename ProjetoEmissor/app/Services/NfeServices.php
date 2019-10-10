<?php


namespace App\Services;

use mysql_xdevapi\Exception;
//require VENDOR_DIR . 'autoload.php';
require_once "../vendor/autoload.php";
use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use stdClass;


class NfeServices {
    Private $config;
    private $tools;
     Public Function __construct($config){
        $this->config = $config;
        $certificadoDigital = file_get_contents('C:\iComercio\NEURIVALDA_ALVES_DA_ALMEIDA.pfx');
        $this->tools = new Tools(Json_encode($config),Certificate::readPfx($certificadoDigital, '12345678'));


     }

    Public Function GerarNfe(){

         // CRIAR UMA NOTA VAZIA
        $nfe = new Make();
       //**********INF NFE***************
        $std = new stdClass();
        $std->versao = '4.00'; //versão do layout
       // $std->Id = 'NFe35150271780456000160550010000000021800700082'; //se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL

        $nfe->taginfNFe($std);

        //**********IDE***************
        $stdIde = new stdClass();
        $std->cUF = 17;
        $std->cNF = rand(11111111, 99999999);
        $std->natOp = 'VENDA';
        $std->mod = 55;
        $std->serie = 1;
        $std->nNF = 30;
        $std->dhEmi = '2019-10-08T17:50:00-02:00';
        $std->dhSaiEnt = '2019-10-08T17:50:00-02:00';
        //$std->dhEmi = date("y-m-d\TH:i:sP");
        //$std->dhSaiEnt = date("y-m-d\TH:i:sP");
        $std->tpNF = 1; // ENTRADA OU SAIDA
        $std->idDest = 1; // SE É DENTRO OU FORA DO ESTADO
        $std->cMunFG = 1721000; // codigo IBGE "palmas"
        $std->tpImp = 1;
        $std->tpEmis = 1;
        $std->cDV = 2;
        $std->tpAmb = 2;
        $std->finNFe = 1;
        $std->indFinal = 1;
        $std->indPres = 0;
        $std->procEmi = 0;
        $std->verProc = '3.10.31';
        $std->dhCont = null;
        $std->xJust = null;

        $nfe->tagide($std);

        //******EMITENTE*********
        $std = new stdClass();
        $std->xNome = "NEURIVALDA ALVES ALMEIDA EIRELI";
        $std->xFant = "COMERCIAL NOVO HORIZONTE";
        $std->IE = 294809449;
        $std->IEST = "";
        $std->IM = "";
        $std->CNAE = "";
        $std->CRT = "1";
        $std->CNPJ = "27448296000164"; //indicar apenas um CNPJ ou CPF
        $std->CPF = "";

        $nfe->tagemit($std);

        //******ENDEREÇO DO EMITENTE*******
        $std = new stdClass();
        $std->xLgr = "AV ELIFAS ALVES BANDEIRA";
        $std->nro = 000;
        $std->xCpl = "";
        $std->xBairro = "CENTRO";
        $std->cMun = 1705607;
        $std->xMun = "CONCEICAO DO TOCANTINS";
        $std->UF = "TO";
        $std->CEP = 77305000;
        $std->cPais = 1058;
        $std->xPais = "BRASIL";
        $std->fone = 6333811105;

        $nfe->tagenderEmit($std);

        //******DESTINATARIO*********
        $std = new stdClass();
        $std->xNome = "FUNDO MUNICIPAL DE EDUCACAO DE TAIPAS";
        $std->indIEDest = 9;
        $std->IE = "";
        $std->ISUF = "";
        $std->IM = "";
        $std->email = "";
        $std->CNPJ = 21405744000166; //indicar apenas um CNPJ ou CPF ou idEstrangeiro
        $std->CPF = "";
        $std->idEstrangeiro = "";

        $nfe->tagdest($std);
        //******ENDEREÇO DO DESTINATARIO*******

        $std = new stdClass();
        $std->xLgr = "RUA SERAFIN TELES";
        $std->nro = "SN";
        $std->xCpl = "";
        $std->xBairro = "CENTRO";
        $std->cMun = 1720937;
        $std->xMun = "TAIPAS DO TOCANTINS";
        $std->UF = "TO";
        $std->CEP = 77308000;
        $std->cPais = 1058;
        $std->xPais = "BRASIL";
        $std->fone = 6333821115;
        $nfe->tagenderDest($std);

     //******PRODUTOS*******
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->cProd = 14962;
        $std->cEAN = "7896090122547";
        $std->xProd = "PALHA DE ACO ASSOLAN N1";
        $std->NCM = 73231000;
        $std->CEST = "";
        $std->indEscala = 'S'; //incluido no layout 4.00

        $std->cBenef = ""; //incluido no layout 4.00

        $std->EXTIPI = "";
        $std->CFOP = 5102;
        $std->uCom = "UN";
        $std->qCom = 3.0000;
        $std->vUnCom = 20.0000000000;
        $std->vProd = 60.00;
        $std->cEANTrib = "7896090122547";
        $std->uTrib = "UN";
        $std->qTrib = 3.0000;
        $std->vUnTrib = 20.0000000000;
        //$std->vFrete = 0.00;
        //$std->vSeg = 0.00;
       // $std->vDesc = 0.00;
      //  $std->vOutro = 0.00;
        $std->indTot = 1;
        $std->xPed = "";
        $std->nItemPed = "";
        $std->nFCI = "";

        $nfe->tagprod($std);

        //******IMPOSTO*******
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->vTotTrib = 2.52;

        $nfe->tagimposto($std);

        //******ICMS*******

        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->orig = 0;
        $std->CSOSN = 102;
        $std->pCredSN = null;
        $std->vCredICMSSN = null;
        $std->modBCST = null;
        $std->pMVAST = null;
        $std->pRedBCST = null;
        $std->vBCST = null;
        $std->pICMSST = null;
        $std->vICMSST = null;
        $std->vBCFCPST = null; //incluso no layout 4.00
        $std->pFCPST = null; //incluso no layout 4.00
        $std->vFCPST = null; //incluso no layout 4.00
        $std->vBCSTRet = null;
        $std->pST = null;
        $std->vICMSSTRet = null;
        $std->vBCFCPSTRet = null; //incluso no layout 4.00
        $std->pFCPSTRet = null; //incluso no layout 4.00
        $std->vFCPSTRet = null; //incluso no layout 4.00
        $std->modBC = null;
        $std->vBC = null;
        $std->pRedBC = null;
        $std->pICMS = null;
        $std->vICMS = null;
        $std->pRedBCEfet = null;
        $std->vBCEfet = null;
        $std->pICMSEfet = null;
        $std->vICMSEfet = null;
        $std->vICMSSubstituto = null;

        $nfe->tagICMSSN($std);
            //**IPI*****
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->clEnq = null;
        $std->CNPJProd = null;
        $std->cSelo = null;
        $std->qSelo = null;
        $std->cEnq = 999;
        $std->CST = 53;
        $std->vIPI = 0.00;
        $std->vBC = 0.00;
        $std->pIPI = 0.00;
        $std->qUnid = null;
        $std->vUnid = null;

        $nfe->tagIPI($std);

        //**PIS*****
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->CST = 99;
        $std->vBC = 0.00;
        $std->pPIS = 0.0000;
        $std->vPIS = 0.00;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagPIS($std);
        //**COFINS*****
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->CST = 99;
        $std->vBC = 0.00;
        $std->pCOFINS = 0.0000;
        $std->vCOFINS =  0.00;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagCOFINS($std);

     //*******TOTAIS**********
        $std = new stdClass();
        $std->vBC = 0.00;
        $std->vICMS = 0.00;
        $std->vICMSDeson = 0.00;
        $std->vFCP = 0.00; //incluso no layout 4.00
        $std->vBCST = 0.00;
        $std->vST = 0.00;
        $std->vFCPST = 0.00; //incluso no layout 4.00
        $std->vFCPSTRet = 0.00; //incluso no layout 4.00
        $std->vProd = 60.00;
        $std->vFrete = 0.00;
        $std->vSeg = 0.00;
        $std->vDesc = 0.00;
        $std->vII = 0.00;
        $std->vIPI = 0.00;
        $std->vIPIDevol = 0.00; //incluso no layout 4.00
        $std->vPIS = 0.00;
        $std->vCOFINS = 0.00;
        $std->vOutro = 0.00;
        $std->vNF = 60.00;
        $std->vTotTrib = 2.52;

        $nfe->tagICMSTot($std);

        //******FRETE********
        $std = new stdClass();
        $std->modFrete = 1;

        $nfe->tagtransp($std);

        //*****FATURA*******
        $std = new stdClass();
        $std->nFat = '999';
        $std->vOrig = 60.00;
        $std->vDesc = null;
        $std->vLiq = 60.00;

        $nfe->tagfat($std);

        //***DUPLICATAS****
//        $std = new stdClass();
//        $std->nDup = '1233-1';
//        $std->dVenc = '2019-11-04';
//        $std->vDup = 60.00;
//        $nfe->tagdup($std);

        $std = new stdClass();
        $std->vTroco = 0.00; //incluso no layout 4.00, obrigatório informar para NFCe (65)
        $nfe->tagpag($std);

        //*****PAGAMENTO******
        $std = new stdClass();
        $std->tPag = '01';
        $std->vPag = 60.00; //Obs: deve ser informado o valor pago pelo cliente
        //$std->CNPJ = '12345678901234';
        //$std->tBand = '01';
        //$std->cAut = '3333333';
        //$std->tpIntegra = 1; //incluso na NT 2015/002
        $std->indPag = '0'; //0= Pagamento à Vista 1= Pagamento à Prazo
        $nfe->tagdetPag($std);

       //*****INFORMAÇÕES ADICIONAIS*********
        $std = new stdClass();
        $std->infAdFisco = 'informacoes para o fisco';
        $std->infCpl = 'informacoes complementares';
        $nfe->taginfAdic($std);

        //**********RESPONSAVEL TECNICO*****************
        $std = new stdClass();
        $std->CNPJ = '01599231000126';
        $std->xContato = 'usa o void';
        $std->email = 'aristotelislacerda10@gmail.com';
        $std->fone = '984552147';
        //$std->CSRT = 'G8063VRTNDMO886SFNK5LDUDEI24XJ22YIPO'; //Código de Segurança do Responsável Técnico
        $std->idCSRT = '01'; //Identificador do CSRT
        $nfe->taginfRespTec($std);

       //****MONTA A NOTA**********

       if ($nfe->montaNFe()) {
            return $nfe->getXML();
       }else{
           throw new \Exception("Erro ao gerar NFe");
       }
    }
    public function assinar($xml){
        return $this->tools->signNFe($xml);
    }
}