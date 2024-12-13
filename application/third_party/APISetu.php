<?php
/**
 * 	APISetu
 *
 * 	Author	: Sanjay Oraon
 * 	date	:	06-07-2023
 * 
 *	
 */
class APISetu 
{
    public function getCompanyAndDirectorsDetails($cin)
    {
		$CLIENTID = CLIENTID;
		$APIKEY = APIKEY;
		
		//Fetch Company Details
		
        $curl = curl_init();
		
		curl_setopt_array($curl, [
		  CURLOPT_URL => "https://apisetu.gov.in/mca/v1/companies/{$cin}",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => [
			"X-APISETU-CLIENTID: {$CLIENTID}",
			"X-APISETU-APIKEY: {$APIKEY}"
		  ],
		]);

		$response_company = curl_exec($curl);
		$err_company = curl_error($curl);

		curl_close($curl);


		//Fetch Directors Details
		
		$curl = curl_init();

		curl_setopt_array($curl, [
		  CURLOPT_URL => "https://apisetu.gov.in/mca-directors/v1/companies/{$cin}",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => [
			"X-APISETU-CLIENTID: {$CLIENTID}",
			"X-APISETU-APIKEY: {$APIKEY}"
		  ],
		]);

		$response_director = curl_exec($curl);
		$err_director = curl_error($curl);

		curl_close($curl);
		
		if ($err_company)
		  return $err_company;
		else if($err_director)
		  return $err_director;
		else 
		  return json_encode(['company' => json_decode($response_company), 'director' => json_decode($response_director)]);
    }
}
