<?php

namespace HnhDigital\Virtualmin;

use GuzzleHttp\Client as Guzzle;

class VirtualminClient
{

    private $server;
    private $username;
    private $password;
    private $mode = 'https';
    private $port = '10000';

    public function __construct($server, $username, $password)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;

        return $this;
    }

    protected function call($program, $parameters = [])
    {
        $url = sprintf('%s://%s:%s/virtual-server/remote.cgi?program=%s&json=1', $this->mode, $this->server, $this->port, $program);

        foreach ($parameters as $key => &$value) {
            if ($value === true) {
                $value = '';
            }
        }

        try {
            $response = (new Guzzle())->post($url, [
                'auth'        => [$this->username, $this->password],
                'form_params' => $parameters,
                'verify' => false,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception('Failed to connect - '.$exception->getMessage());
        }


        $result = json_decode($response->getBody()->getContents(), true);


        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg());
        }

        if ($result['status'] != 'success') {
            throw new \Exception($result['error']);
        }

        if (isset($result['output'])) {
            return $result['output'];
        } elseif (stripos($program, 'list-') === false) {
            return true;
        }

        // Re-create result into a sensible array.
        $data = [];

        foreach ($result['data'] as $key => $row) {
            $data[$key] = [
                'name' => $row['name'],
            ];

            foreach ($row['values'] as $name => $value) {
                $data[$key][$name] = $value[0];
            }
        }

        return $data;
    }

}
