<?php

namespace Bluora\Virtualmin\Server;

use Bluora\Virtualmin\VirtualminClient;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ServerClient extends VirtualminClient
{

    public function info()
    {
        $parameters = [];

        $data = $this->call('info', $parameters);
        $data = str_replace('    * ', '    - ', $data);
        $callback = function($matches) {
            return 'desc: '.str_replace(':', '-', $matches[0]);
        };
        $data = preg_replace_callback("/desc: (.*?)$/sm", $callback, $data);
        $parsed_data = Yaml::parse($data);

        return $parsed_data;
    }

    public function ip()
    {
        $parameters = [];
        $parameters['name-only'] = true;

        return $this->call('list-shared-addresses', $parameters);
    }

}
