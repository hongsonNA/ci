<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['socket_type'] = 'tcp'; //`tcp` or `unix`
$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
$config['host'] = '127.0.0.1';
$config['password'] = NULL;
$config['port'] = 6379;
$config['timeout'] = 0;

// $config['redis_default']['host'] = 'localhost';		// IP address or host
// $config['redis_default']['port'] = '6379';			// Default Redis port is 6379
// $config['redis_default']['password'] = '';			// Can be left empty when the server does not require AUTH

// $config['redis_slave']['host'] = '';
// $config['redis_slave']['port'] = '6379';
// $config['redis_slave']['password'] = '';
?>
