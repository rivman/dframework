<?php
/**
 * dFramework
 *
 * The simplest PHP framework for beginners
 * Copyright (c) 2019, Dimtrov Group Corp
 * This content is released under the Mozilla Public Licence License (MPL-2.0)
 *
 * @package	dFramework
 * @author	Dimitric Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @copyright	Copyright (c) 2019, Dimtrov Group Corp. (https://dimtrov.hebfree.org)
 * @copyright	Copyright (c) 2019, Dimitric Sitchet Tomkeu. (https://www.facebook.com/dimtrovich)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://dimtrov.hebfree.org/works/dframework
 * @version 2.0
 */

/**
 * Validator
 *
 * Form Validator
 *
 * @package		dFramework
 * @subpackage	Library
 * @author		Dimitri Sitchet Tomkeu <dev.dimitrisitchet@gmail.com>
 * @link		https://dimtrov.hebfree.org/works/dframework/docs/Validator.html
 */


class dF_Validator
{
    private $field = [];

    private $use_input_field = false;


    /**
     * dF_Validator constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param bool $using
     * @param array $field
     */
    public function useInputField(bool $using, ?array $field = array())
    {
        $this->use_input_field = $using;
        $this->field = $field;
    }


    /**
     * @param string ...$vars
     * @return bool
     */
    public function inField(string ...$vars)
    {
        $status = true;
        foreach ($vars As $var)
        {
            if($status === false)
            {
                break;
            }
            $status = !empty($this->field[$var]);
        }
        return $status;
    }

    /**
     * @param $value
     * @param array|string $array
     * @return bool
     * @throws Exception
     */
    public function in($value, $array)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        if(is_string($array)) {
            $array = explode(';', $array);
        }
        if(!is_array($array)) {
            throw new Exception('Unsupported parameter to second argument. use a string or array variable');
        }
        return in_array($value, $array);
    }

    /**
     * Verifie si une donnee est une date valide
     *
     * @param $value
     * @param string $format
     * @return bool
     * @throws Exception
     */
    public function is_date($value, string $format = 'dd/mm/yyyy')
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        $format = strtoupper($format);

        if(in_array($format, ['DMY', 'DDMMYY']))
        {
            $day    = substr($value, 0, 2);
            $month  = substr($value, 2, 2);
            $year   = substr($value, 4, 2);
        }
        else if(in_array($format, ['D/M/Y', 'D:M:Y', 'D-M-Y', 'D_M_Y', 'D M Y', 'D.M.Y']))
        {
            $day    = substr($value, 0, 2);
            $month  = substr($value, 3, 2);
            $year   = substr($value, 6, 2);
        }
        else if(in_array($format, ['MDY', 'MMDDYY']))
        {
            $day    = substr($value, 2, 2);
            $month  = substr($value, 0, 2);
            $year   = substr($value, 4, 2);
        }
        else if(in_array($format, ['M/D/Y', 'M:D:Y', 'M-D-Y', 'M_D_Y', 'M D Y', 'M.D.Y']))
        {
            $day    = substr($value, 3, 2);
            $month  = substr($value, 0, 2);
            $year   = substr($value, 6, 2);
        }
        else if(in_array($format, ['YMD', 'YYMMDD']))
        {
            $day    = substr($value, 4, 2);
            $month  = substr($value, 2, 2);
            $year   = substr($value, 0, 2);
        }
        else if(in_array($format, ['Y/M/D', 'Y:M:D', 'Y-M-D', 'Y_M_D', 'Y M D', 'Y.M.D']))
        {
            $day    = substr($value, 6, 2);
            $month  = substr($value, 3, 2);
            $year   = substr($value, 0, 2);
        }
        else if(in_array($format, ['DDMMYYYY']))
        {
            $day    = substr($value, 0, 2);
            $month  = substr($value, 2, 2);
            $year   = substr($value, 4, 4);
        }
        else if(in_array($format, ['DD/MM/YYYY','DD:MM:YYYY','DD-MM-YYYY','DD_MM_YYYY','DD MM YYYY','DD.MM.YYYY']))
        {
            $day    = substr($value, 0, 2);
            $month  = substr($value, 3, 2);
            $year   = substr($value, 6, 4);
        }
        else if(in_array($format, ['MMDDYYYY']))
        {
            $day    = substr($value, 2, 2);
            $month  = substr($value, 0, 2);
            $year   = substr($value, 4, 4);
        }
        else if(in_array($format, ['MM/DD/YYYY', 'MM:DD:YYYY', 'MM-DD-YYYY', 'MM_DD_YYYY', 'MM DD YYYY', 'MM.DD.YYYY']))
        {
            $day    = substr($value, 3, 2);
            $month  = substr($value, 0, 2);
            $year   = substr($value, 6, 4);
        }
        else if(in_array($format, ['YYYYMMDD']))
        {
            $day    = substr($value, 6, 2);
            $month  = substr($value, 4, 2);
            $year   = substr($value, 0, 4);
        }
        else if(in_array($format, ['YYYY/MM/DD','YYYY:MM:DD','YYYY-MM-DDDD','YYYY_MM_DD','YYYY MM DDDD','YYYY.MM.DD']))
        {
            $day    = substr($value, 8, 2);
            $month  = substr($value, 5, 2);
            $year   = substr($value, 0, 4);
        }
        else
        {
            throw new Exception('Unsupported type of format for the date. Please see the manual for more information');
        }
        $day = (int) $day; $month = (int) $month; $year = (int) $year;

        if($month < 1 OR $month > 12)
        {
            return false;
        }
        if(in_array($month, [1, 3, 5, 7, 8, 10, 12]))
        {
            return ($day >= 1 AND $day <= 31);
        }
        if ($month == 2)
        {
            return (($day >= 1 AND $day <= 28) OR ($day == 29 AND ($year % 4) == 0));
        }
        return ($day >= 1 AND $day <= 30);
    }


    /**
     * Verifie si une donne ne contient que des caractere alphabetique ou que c'est un tableau qui n'a que des caractere aphabetique
     * @param string|array $value
     * @return bool
     */
    public function is_alpha($value) : bool
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        if(is_array($value))
        {
            foreach ($value as $k => $v)
            {
                if(!is_string($v))
                {
                    return false;
                }
                $strlen = strlen($v);
                if($strlen < 0 OR !preg_match("#^(?:[[:alpha:]]){".$strlen."}$#", $v))
                {
                    return false;
                }
            }
            return true;
        }
        if(is_string($value))
        {
            $strlen = strlen($value);
            return ($strlen > 0 AND preg_match("#^(?:[[:alpha:]]){".$strlen."}$#", $value));
        }
        return false;
    }

    /**
     * Verifie si une donne ne contient que des caractere alphanumerique ou que c'est un tableau qui n'a que des caractere aphanumerique
     *
     * @param string|array $value
     * @return bool
     */
    public function is_alphanum($value)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        if(is_array($value))
        {
            foreach ($value As $v)
            {
                if(!is_string($v))
                {
                    return false;
                }
                $strlen = strlen($v);
                if($strlen < 0 OR !preg_match("#^(?:[[:alnum:]]){".$strlen."}$#", $v))
                {
                    return false;
                }
            }
            return true;
        }
        if(is_string($value))
        {
            $strlen = strlen($value);
            return ($strlen > 0 AND preg_match("#^(?:[[:alnum:]]){".$strlen."}$#", $value));
        }
        return false;
    }

    /**
     * Verifie si une donnee est une adresse email valide
     *
     * @param mixed $value
     * @return bool
     */
    public function is_email($value)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null): $value;
        return !(filter_var($value, FILTER_VALIDATE_EMAIL) === false);
    }

    /**
     * Verifie si deux donnees sont egales ou identique
     *
     * @param mixed $a
     * @param mixed $b
     * @param bool $strict
     * @return bool
     */
    public function is_equal($a, $b, $strict = false)
    {
        $a = (true == $this->use_input_field) ? ($this->field[$a] ?? null) : $a;
        $b = (true == $this->use_input_field) ? ($this->field[$b] ?? null) : $b;

        if(true == $strict) {
            return $a === $b;
        }
        return $a == $b;
    }

    /**
     * Verifie si une donnees correspond a une adresse ip valide
     *
     * @param $value
     * @return bool
     */
    public function is_ip($value)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null): $value;
        return !(filter_var($value, FILTER_VALIDATE_IP) === false);
    }

    /**
     * Verifie si une donnee est une url
     *
     * @param $value
     * @param bool $natif
     * @return bool
     */
    public function is_url($value, bool $natif = false)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null): $value;

        if($natif === true) {
            return !(filter_var($value, FILTER_VALIDATE_URL) === false);
        }
        // Regex realisée par Scott Gonzalez: http://projects.scottsplayground.com/iri/
        /*
            Si vous voulez utilser mon regex, la voici -o)
            if(!preg_match('#^(https?|ftp|steam)://([a-z0-9._/-]+)$#i', $value)){...}
        */
        return preg_match("/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i", $value);
    }

    /**
     * Verifie si un chaine a exactement un nombre de caracteres precis
     *
     * @param string $value
     * @param int $length
     * @return bool
     */
    public function length(string $value, int $length)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        return strlen(trim($value)) == $length;
    }
    /**
     * Verifie si une chaine a une longueur comprise entre une valeur minimale et une valeur maximale
     *
     * @param string $value
     * @param int $min
     * @param int $max
     * @param bool $inclusive
     * @return bool
     */
    public function length_between(string $value, int $min, int $max, bool $inclusive = false) : bool
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;

        if(!$inclusive)
        {
             return (strlen(trim($value)) < $max AND strlen(trim($value)) > $min);
        }
        else
        {
            return (strlen(trim($value)) <= $max && strlen(trim($value)) >= $min);
        }
    }
    /**
     * @param $value
     * @param int $length
     * @return bool
     */
    public function max_length(string $value, int $length)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        return strlen(trim($value)) <= $length;
    }
    /**
     * @param string $value
     * @param int $length
     * @return bool
     */
    public function min_length(string $value, int $length)
    {
        $value = (true == $this->use_input_field) ? ($this->field[$value] ?? null) : $value;
        return strlen(trim($value)) >= $length;
    }


    /**
     * @param $input
     * @param string $functions
     * @param callable|null $callback
     * @return mixed
     * @throws Exception
     */
    public function check($input, string $functions, ?callable $callback = null)
    {
        $status = true; $code = 0; $message = '';

        $functions = explode('|', $functions);
        foreach ($functions As $function)
        {
            if($status === false) {
                break;
            }
            $function = trim($function);

            if(preg_match('#^in\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->in($input, $params[1]); $code = 1;
                $message = ($status === true) ? 'Ok' : 'La donnée demandée n\'existe pas dans les entrées';
            }

            if(preg_match('#^is_date\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->is_date($input, $params[1]); $code = 1;
                $message = ($status === true) ? 'Ok' : 'Entrez une date valide';
            }

            if(preg_match('#^is_email$#isU', $function))
            {
                $status = $this->is_email($input); $code = 1;
                $message = ($status === true) ? 'Ok' : 'Entrez une adresse email valide';
            }

            if(preg_match('#^is_equal\[(.+)\]$#isU', $function, $params))
            {
                $params[1] = explode(';', $params[1]);
                $status = $this->is_equal($input, $params[1][0], $params[1][1] ?? false);
                $code = 2;
                $message = ($status === true) ? 'Ok' : 'Les données ne correspondent pas';
            }

            if(preg_match('#^is_ip$#isU', $function))
            {
                $status = $this->is_ip($input);
                $code = 3;
                $message = ($status === true) ? 'Ok' : 'Entrez une adresse ip valide';
            }

            if(preg_match('#^is_url\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->is_url($input, (bool) $params[1]);
                $code = 3;
                $message = ($status === true) ? 'Ok' : 'Entrez une url valide';
            }

            if(preg_match('#^length\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->length($input, $params[1]);
                $code = 1;
                $message = ($status === true) ? 'Ok' : 'Entrez un chaine ayant '.$params[1].' caracteres';
            }
            if(preg_match('#^max_length\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->max_length($input, $params[1]);
                $code = 3;
                $message = ($status === true) ? 'Ok' : 'Entrez un chaine d\'au plus '.$params[1].' caracteres';
            }
            if(preg_match('#^min_length\[(.+)\]$#isU', $function, $params))
            {
                $status = $this->min_length($input, $params[1]);
                $code = 2;
                $message = ($status === true) ? 'Ok' : 'Entrez un chaine d\'au moins '.$params[1].' caracteres';
            }
        }

        if(!is_null($callback) AND is_callable($callback))
        {
            return call_user_func_array($callback, compact('status', 'code', 'message'));
        }
        return $status;
    }

}