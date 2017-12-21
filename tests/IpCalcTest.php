<?php

use PHPUnit\Framework\TestCase;

class IpCalcTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     * @param $cidr
     * @param $min
     * @param $max
     */
    public function testSimple($cidr, $min, $max)
    {
        $calc = new \Blackbass\IpCalc(false);
        list($actualMin, $actualMax) = $calc->getMinMaxIpLongFromCidr($cidr, false);

        $this->assertEquals($min, $actualMin, "network was " . $cidr);
        $this->assertEquals($max, $actualMax, "network was " . $cidr);
        
    }


    /**
     * @dataProvider dataProviderOnlyHosts
     * @param $cidr
     * @param $min
     * @param $max
     */
    public function testOnlyHosts($cidr, $min, $max)
    {
        $calc = new \Blackbass\IpCalc(true);
        list($actualMin, $actualMax) = $calc->getMinMaxIpLongFromCidr($cidr, false);

        $this->assertEquals($min, $actualMin, "network was " . $cidr);
        $this->assertEquals($max, $actualMax, "network was " . $cidr);

    }

    public function dataProvider()
    {
        return [
            [
                "127.0.0.1/32",
                "127.0.0.1",
                "127.0.0.1",
            ],
            [
                "127.0.0.1",
                "127.0.0.1",
                "127.0.0.1",
            ],
            [
                "192.168.0.5/24",
                "192.168.0.0",
                "192.168.0.255",
            ],
            [
                "192.168.0.5/16",
                "192.168.0.0",
                "192.168.255.255",
            ],
            [
                "192.168.0.5/4",
                "192.0.0.0",
                "207.255.255.255",
            ],
        ];
    }

    public function dataProviderOnlyHosts()
    {
        return [
            [
                "127.0.0.1/32",
                "127.0.0.1",
                "127.0.0.1",
            ],
            [
                "127.0.0.1",
                "127.0.0.1",
                "127.0.0.1",
            ],
            [
                "192.168.0.5/24",
                "192.168.0.1",
                "192.168.0.254",
            ],
            [
                "192.168.0.5/16",
                "192.168.0.1",
                "192.168.255.254",
            ],
            [
                "192.168.0.5/4",
                "192.0.0.1",
                "207.255.255.254",
            ],
        ];
    }
}
