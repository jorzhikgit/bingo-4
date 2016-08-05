<?php

/**
 * Get Default System Configuration from config/simmfins
 *
 * @param string $configName The name of the configuration
 * @return mixed
 */
function get_default_config($configName)
{
    return Config::get($configName);
}

function full_date($date, $format = 'F d, Y')
{
	if ( ! $date) return $date;

	$date = new \DateTime($date);
    return date_format($date, $format);
}