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


  		$this->soapWrapper->add(NULL, function ($service) {
	      $service
	        ->wsdl('https://agenda.ws.clinicasanfelipe.com/WsAgendaCitas/Agenda.asmx?WSDL')
	        ->trace(true)
	        ->options(['User'=> 'MEDISYN', 'Password'=> 'csfcsf']);
	    });

      
      $data = array(

        'Cod_Empresa' => '16',
        'Cod_Sucursal' => '0',
        'Rut_Paciente' => '20100162742',
        'Dv_Paciente' => '',
        'Usuario' => 'UINTERNET',
        'CodPacienteConsulta' => '0'
       );

      // $response = $this->soapWrapper->__getTypes();

	     $response = $this->soapWrapper->call('WM_BuscaPacienteTitularV2', $data);

	     return $response;



  	}

  	public function WM_LogeoPaciente (){

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
}
