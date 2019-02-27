<?php

namespace Per3evere\Nsq\Lookup;

use Per3evere\Nsq\Exception\LookupException;

interface LookupInterface
{
    /**
     * Lookup hosts for a given topic
     *
     * @param string $topic
     *
     * @throws LookupException If we cannot talk to / get back invalid response
     *      from nsqlookupd
     *
     * @return array Should return array [] = host:port
     */
    public function lookupHosts($topic);
}