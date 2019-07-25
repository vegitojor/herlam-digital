<?php

Class EnvioPack {

	const BASE_URL = "https://api.enviopack.com/";

	private $apiKey = "b2769847a503b5bee4aee758493acee9001eb210";
	private $secretKey = "d2ff5919cc19009ae720db3d909bc383e3bd5a2e";
	private $accessToken;
	private $refreshtoken;
	private $domicilioEnvio = 1901;


	//POST
	function __construct(){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "auth" );
		//se setea el tipo POST
		curl_setopt($ch, CURLOPT_POST, 1);
		//se establecen los parametros
		curl_setopt($ch, CURLOPT_POSTFIELDS, "api-key=" . $this->apiKey . "&secret-key=" . $this->secretKey);
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$respuesta = json_decode( curl_exec($ch) );
		curl_close ($ch);
		$this->accessToken = $respuesta->token;
		$this->refreshtoken = $respuesta->refresh_token;
	}

	public function getAccessToken(){
		return $this->accessToken;
	}

	//GET
	public function getProvincias(){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "provincias?access_token=" . $this->accessToken );
		
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close ($ch);
		return json_decode( $output );
	}

	//GET
	public function getLocalidades( $idProvincia ){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "localidades?access_token=" . $this->accessToken . "&id_provincia=" . $idProvincia );
		
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec($ch);
		curl_close ($ch);
		return json_decode( $output );
	}

	//GET
	public function calcularCostoEnviodomicilio( $provincia, $codigoPostal, $peso, $paquetes, $servicio ){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "cotizar/precio/a-domicilio?access_token=" . $this->accessToken . "&provincia=" . $provincia .
				"&codigo_postal=" . $codigoPostal . "&peso=" . $peso . "&paquetes=" . $paquetes . "&servicio=" . $servicio );
		
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec($ch);
		curl_close ($ch);
		return $output;
	}


	//GET
	public function getCorreos( $filtrarActivos ){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "correos?access_token=" . $this->accessToken . "&filtrar_activos=" . $filtrarActivos );
		
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec($ch);
		curl_close ($ch);
		return $output;
	}

	//GET
	public function calcularCostoEnvioSucursal( $provincia, $localidad, $peso, $paquetes, $correo ){
		//se inicializa el manipulador de la solicitud HTTP
		$ch = curl_init( self::BASE_URL . "cotizar/precio/a-sucursal?access_token=" . $this->accessToken . "&provincia=" . $provincia .
				"&localidad=" . $localidad . "&peso=" . $peso . "&paquetes=" . $paquetes . "&correo=" . $correo . "&domicilio_envio=" . $this->domicilioEnvio );
		
		//se informa que se espera una respuesta
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec($ch);
		curl_close ($ch);
		return $output;
	}
	
}