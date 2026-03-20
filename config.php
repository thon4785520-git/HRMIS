<?php
if (!defined('HRMIS_PHP8_CONFIG')) {
    define('HRMIS_PHP8_CONFIG', true);

    $GLOBALS['__hrmis_mysql_link'] = null;

    if (!function_exists('hrmis_mysql_link')) {
        function hrmis_mysql_link()
        {
            if (($GLOBALS['__hrmis_mysql_link'] ?? null) instanceof mysqli) {
                return $GLOBALS['__hrmis_mysql_link'];
            }

            $host = getenv('HRMIS_DB_HOST') ?: '127.0.0.1';
            $user = getenv('HRMIS_DB_USER') ?: 'root';
            $pass = getenv('HRMIS_DB_PASS') ?: '';
            $name = getenv('HRMIS_DB_NAME') ?: 'hrmis';
            $port = (int) (getenv('HRMIS_DB_PORT') ?: 3306);
            $charset = getenv('HRMIS_DB_CHARSET') ?: 'tis620';

            mysqli_report(MYSQLI_REPORT_OFF);
            $link = @mysqli_connect($host, $user, $pass, $name, $port);
            if (!$link) {
                return false;
            }

            @mysqli_set_charset($link, $charset);
            $GLOBALS['__hrmis_mysql_link'] = $link;

            return $link;
        }
    }

    if (!function_exists('mysql_connect')) {
        function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
        {
            unset($new_link, $client_flags);
            $server = $server ?: (getenv('HRMIS_DB_HOST') ?: '127.0.0.1');
            $username = $username ?: (getenv('HRMIS_DB_USER') ?: 'root');
            $password = $password ?? (getenv('HRMIS_DB_PASS') ?: '');
            $dbName = getenv('HRMIS_DB_NAME') ?: 'hrmis';
            $port = (int) (getenv('HRMIS_DB_PORT') ?: 3306);
            $charset = getenv('HRMIS_DB_CHARSET') ?: 'tis620';

            mysqli_report(MYSQLI_REPORT_OFF);
            $link = @mysqli_connect($server, $username, $password, $dbName, $port);
            if ($link) {
                @mysqli_set_charset($link, $charset);
                $GLOBALS['__hrmis_mysql_link'] = $link;
            }

            return $link;
        }
    }

    if (!function_exists('mysql_select_db')) {
        function mysql_select_db($database_name, $link_identifier = null)
        {
            $link_identifier = $link_identifier ?: hrmis_mysql_link();
            if (!$link_identifier) {
                return false;
            }

            return @mysqli_select_db($link_identifier, $database_name);
        }
    }

    if (!function_exists('mysql_query')) {
        function mysql_query($query, $link_identifier = null)
        {
            $link_identifier = $link_identifier ?: hrmis_mysql_link();
            if (!$link_identifier) {
                return false;
            }

            return @mysqli_query($link_identifier, $query);
        }
    }

    if (!function_exists('mysql_fetch_array')) {
        function mysql_fetch_array($result, $result_type = MYSQLI_BOTH)
        {
            return $result ? mysqli_fetch_array($result, $result_type) : false;
        }
    }

    if (!function_exists('mysql_fetch_assoc')) {
        function mysql_fetch_assoc($result)
        {
            return $result ? mysqli_fetch_assoc($result) : false;
        }
    }

    if (!function_exists('mysql_fetch_row')) {
        function mysql_fetch_row($result)
        {
            return $result ? mysqli_fetch_row($result) : false;
        }
    }

    if (!function_exists('mysql_num_rows')) {
        function mysql_num_rows($result)
        {
            return $result ? mysqli_num_rows($result) : 0;
        }
    }

    if (!function_exists('mysql_real_escape_string')) {
        function mysql_real_escape_string($string, $link_identifier = null)
        {
            $link_identifier = $link_identifier ?: hrmis_mysql_link();
            return $link_identifier ? mysqli_real_escape_string($link_identifier, (string) $string) : addslashes((string) $string);
        }
    }

    if (!function_exists('mysql_error')) {
        function mysql_error($link_identifier = null)
        {
            $link_identifier = $link_identifier ?: hrmis_mysql_link();
            return $link_identifier ? mysqli_error($link_identifier) : 'Database connection is not available.';
        }
    }

    if (!function_exists('mysql_close')) {
        function mysql_close($link_identifier = null)
        {
            $link_identifier = $link_identifier ?: ($GLOBALS['__hrmis_mysql_link'] ?? null);
            if (!$link_identifier) {
                return true;
            }

            $closed = mysqli_close($link_identifier);
            if ($closed) {
                $GLOBALS['__hrmis_mysql_link'] = null;
            }

            return $closed;
        }
    }

    if (!function_exists('Timing')) {
        function Timing($timeValue)
        {
            if (empty($timeValue) || $timeValue === '00:00:00') {
                return 0;
            }

            $parts = explode(':', (string) $timeValue);
            if (count($parts) < 2) {
                return 0;
            }

            return ((int) $parts[0]) + (((int) $parts[1]) / 100);
        }
    }

    hrmis_mysql_link();
}
