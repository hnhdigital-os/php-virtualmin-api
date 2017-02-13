<?php

namespace Bluora\Virtualmin;

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


    }

}
