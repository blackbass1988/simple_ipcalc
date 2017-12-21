# simple_ipcalc

Simple IpCalculator (now only for ipv4)

install
===

```
composer require blackbass/simple_ipcalc
```



usage
===


```php
$calc = new \Blackbass\IpCalc();
list($minAddr, $maxAddr) = $calc->getMinMaxIpLongFromCidr("192.168.0.1/24");
```


see tests for more examples