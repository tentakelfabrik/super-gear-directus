<?php

namespace SuperGear\Directus\Collections;

/**
 * send request with curl to directus instance
 *
 *
 * @author Björn Hase
 * @license http://opensource.org/licenses/MIT The MIT License
 * @link https://gitlab.tentakelfabrik.de/super-gear/directus GitHub Repository
 *
 */
class AbstractCollection
{
    /** url */
    private $url = NULL;

    /** token */
    private $token = NULL;

    /** curl */
    private $curl = NULL;

    /** endpoint */
    protected $endpoint = NULL;

    /**
     *
     *  @param string $url
     *  @param string $token
     */
    public function __construct($url, $token)
    {
        $this->url = $url;
        $this->token = $token;
    }

    /**
     *
     *
     *  @param  string $name
     *  @param  array $parameters
     *  @return mixed
     */
    public function findOne($name, $parameters = [])
    {
        // adding single to parameters
        $parameters['single'] = true;
        $response = $this->request($name, $this->endpoint, $parameters);

        return $response;
    }

    /**
     *
     *
     *  @param  string $name
     *  @param  array $parameters
     *  @return mixed
     *
     */
    public function find($name, $parameters = [])
    {
        return $this->request($name, $this->endpoint, $parameters);
    }

    /**
     *  request $endpoint
     *
     *  @param  string $name
     *  @param  string $endpoint
     *  @param  array $parameters
     *  @return mixed
     *
     */
    protected function request($name, $endpoint, $parameters = [])
    {
        // init curl and setup token
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token
        ]);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = [];

        if (count($parameters) > 0) {
            $query = http_build_query($parameters);
        }

        $url = $this->url.$endpoint.'/'.$name;

        // query parameters are set, add them to url
        if (isset($query)) {
            $url = $url.'?'.$query;
        }

        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($curl);

        curl_close($curl);
        $response = json_decode($response, true);

        return $response;
    }
}
