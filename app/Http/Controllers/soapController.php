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


  		$request = $this->soapWrapper->add('Agenda', function ($service) {
	      $service
	        ->wsdl('https://agenda.ws.clinicasanfelipe.com/WsAgendaCitas/Agenda.asmx?WSDL')
	        ->trace(true)
	        ->cache(WSDL_CACHE_NONE)
	        ->options(['Usuario'=> 'MEDISYN', 'Password'=> 'csfcsf']);
	    });

	     $response = $request->call('Agenda.WM_ObtenerComunas', 

        array(
        	
        'Cod_Empresa' => '16',
        'Cod_Sucursal' => '0',
        'Usuario' => 'UINTERNET',
        'Cod_Ubigeo' => '1391')
        
       );

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
            'cache_wsdl' => WSDL_CACHE_MEMORY, 'Usuario'=> 'MEDISYN', 'Password'=> 'csfcsf');
  		
  		// $client = new \SoapClient($wsdl, $options);

  		$client = new \SoapClient($wsdl, array("Usuario"=> "MEDISYN", "Password"=> "csfcsf", "trace" => 1, "exception" => 0));

  		// $header = new soapHeader(array('Usuario'=> 'MEDISYN', 'Password'=> 'csfcsf'));

  		var_dump($client->__getTypes()); 
  	}
}
