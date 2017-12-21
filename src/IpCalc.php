<?php

namespace Blackbass;

class IpCalc
{
    private $onlyHosts;

    /**
     * IpCalc constructor.
     * @param bool $onlyHosts excludes network and broadcast address
     */
    public function __construct($onlyHosts = false)
    {
        $this->onlyHosts = $onlyHosts;
    }

    /**
     *
     * returns array of min and max addresses
     * @param string $cidr
     * @param bool $returnAsLong if true then function returns array of IP in numeric format
     * @return array
     */
    public function getMinMaxIpLongFromCidr($cidr, $returnAsLong = true)
    {

        $exploded = explode('/', $cidr);
        $maxIpV4 = ip2long('255.255.255.255');

        $ip = $exploded[0];
        $mask = isset($exploded[1])?(int)$exploded[1]:32;

        $ip2long = ip2long($ip);

        if ($mask === 32) {
            $max = $min = $ip2long;
        } else {
            $mask = $maxIpV4 << (32 - $mask);
            $min = $maxIpV4 & ($ip2long & $mask);
            $max = $maxIpV4 & ($ip2long | ~$mask);
        }


        if (true === $this->onlyHosts && $mask !== 32) {
            ++$min;
            --$max;
        }

        if (false === $returnAsLong) {
            $min = long2ip($min);
            $max = long2ip($max);
        }

        return [$min, $max];
    }
}
