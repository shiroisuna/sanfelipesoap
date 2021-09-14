<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;

use SoapClient;

class soapController extends Controller
{
   /**
   * @var SoapWrapper
   */
  protected $soapWrapper;

  

  /**
   * SoapController constructor.
   *
   * @param SoapWrapper $soapWrapper
   */
    public function __construct(SoapWrapper $soapWrapper){
    	$this->soapWrapper = $soapWrapper;
    	
  	}

  /**
   * Use the SoapWrapper
   */
  	public function ConsultaPacienteTitular(){


  		$request = $this->soapWrapper->add(NULL, function ($service) {
	      $service
	        ->wsdl('https://agenda.ws.clinicasanfelipe.com/WsAgendaCitas/Agenda.asmx?WSDL')
	        ->trace(1)
	        ->options(['Usuario'=> 'MEDISYN', 'Password'=> 'csfcsf']);
	    });

  		var_dump($request);
             
  		// // dd($request);
  		

	     $response = $request->call('SanFelipe.WM_BuscaPacienteTitularV2', [

        [
        	
        'Cod_Empresa' => '16',
        'Cod_Sucursal' => '1',
        'Rut_Paciente' => '20100162742',
        'Dv_Paciente' => '',
        'Usuario' => 'UINTERNET',
        'CodPacienteConsulta' => '0']
        
       ]);

	     // return response()->json($response);

	     dd($response);
	    
	     // return $response;



  	}

  	public function LogeoPaciente (){

  		$this->soapWrapper->add(NULL, function ($service) {
	      $service
	        ->wsdl('https://agenda.ws.clinicasanfelipe.com/WsAgendaCitas/Agenda.asmx?WSDL')
	        ->trace(true)
	        ->options(['User'=> 'MEDISYN', 'Password'=> 'csfcsf']);
	    });

	    $data = array(

        'Cod_Empresa' => '16',
        'Cod_Sucursal' => '0',
        'Rut_PacienteTitular' => '',
        'Dv_Paciente' => '',
        'IP_Cliente' => '',
        'Clave_Paciente' => '0',
        'ApiKey' => ''
       );


	     $response = $this->soapWrapper->call('WM_LogeoPaciente', $data);

	     return $response;
  	}


  	public function test(){

  		$wsdl = 'https://agenda.ws.clinicasanfelipe.com/WsAgendaCitas/Agenda.asmx?WSDL';

  		$options = array('trace'=>true, 'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_MEMORY, 'User'=> 'MEDISYN', 'Password'=> 'csfcsf');
  		
  		$client = new \SoapClient($wsdl, [
            'Usuario'=> 'MEDISYN', 
            'Password'=> 'csfcsf',
            'encoding' => 'UTF-8',
            'trace' => true]);

  		var_dump($client->__getTypes()); 
  	}
}
