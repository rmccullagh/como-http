<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 * @author      Ryan McCullagh <ryan@ryanmccullagh.com>
 * @copyright   2014 Ryan McCullagh
 * @link        http://github.com/rmccullagh/como-http
 * @license     http://www.apache.org/licenses/LICENSE-2.0 
 */

namespace Como\Http;

/**
 * Input 
 * 
 * @package como/http 
 * @version $id$
 * @copyright 2014 Ryan McCullagh
 * @author Ryan McCullagh  <ryan@ryanmccullagh.com> 
 * @link http://github.com/rmccullagh/como-http
 */
class Input 
{

    /**
     * Used to indicate if the given method should require the input string
     * to not be an array 
     */
    const FILTER_ARRAY    = 0;

    /**
     * Used to indicate that the input string can be an array 
     */
    const NO_FILTER_ARRAY = 1; 

    /**
     * Checks the request headers for a IP address, and if it is set
     * retuns it. If is not set, it returns null.
     * 
     * @static
     * @access public
     * @return mixed
     */
    public static function ip()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : NULL;
    }
    
    /**
     * Checks the request headers for a user agent string
     * 
     * @static
     * @access public
     * @return mixed
     */
    public static function user_agent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
    }

    /**
     * Checks for the xmlhttprequest header located in X-Request-With request header
     * that most JS frameworks send on AJAX requests
     * 
     * @static
     * @access public
     * @return bool
     */
    public static function is_ajax() 
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';	
    }

    /**
     * With a given key, it checks the $_POST superglobal for the index
     * matching the given key, it then sanitizing the input string, if found, 
     * and returns a string safe for ouput to a client. If $filter_array is 0
     * then it will check if the value of the $_POST array at subscript key is an array
     * and will return false.
     * 
     * @param mixed $key        The key to look for in the $_POST array
     * @param int $filter_array If is set, return null if the value is an array
     * @param mixed $default    The default value to use if no key is found
     * @static
     * @access public
     * @return mixed
     */
    public static function post($key, $filter_array = 0, $default = NULL)
    {
        $item = isset($_POST[$key]) ? $_POST[$key] : NULL;
        if($filter_array === 0) {
            if(is_array($item))
                return NULL;
        }
        return isset($_POST[$key]) ? self::clean($_POST[$key]) : $default;        
    }
    
    /**
     * With a given key, it checks the $_GET superglobal for the index
     * matching the given key, it then sanitizing the input string, if found, 
     * and returns a string safe for ouput to a client. If $filter_array is 0
     * then it will check if the value of the $_GET array at subscript key is an array
     * and will return false.
     * 
     * @param mixed $key        The key to look for in the $_GET array
     * @param int $filter_array If is set, return null if the value is an array
     * @param mixed $default    The default value to use if no key is found
     * @static
     * @access public
     * @return mixed
     */
    public static function get($key, $filter_array = 0, $default = NULL)
    { 
        $item = isset($_GET[$key]) ? $_GET[$key] : NULL;
        if($filter_array === 0) {
            if(is_array($item))
                return NULL;
        }
        return isset($_GET[$key]) ? self::clean($_GET[$key]) : $default;        
    }
    
    /**
     * A recursive method for sanitizing an input string.
     *
     * Given the mixed value type, it checks if that value is an array
     * and calls itself on the value to return a sanitized string.  
     * 
     * @param mixed $type 
     * @static
     * @access public
     * @return void
     */
    public static function clean($type)
    {
        if(is_array($type)) {
            foreach($type as $key => $value){	
                $type[$key] = self::clean($value);
            }
            return $type;
        } else {
            $string = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
            return $string;
        }
    }

    /**
     * Redirects to the given location if the headers were not already sent
     * 
     * @param string $location 
     * @static
     * @access public
     * @return void
     */
    public static function redirect($location)
    {
        if(!headers_sent()) {
            header('HTTP/1.1 301 Moved Permanently');
            header("Location: $location");
            exit;
        }
    }
}
