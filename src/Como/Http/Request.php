<?php
/**
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 * @author      Ryan McCullagh <ryan@ryanmccullagh.com>
 * @copyright   2014 Ryan McCullagh
 * @link        http://github.com/rmccullagh/como_mvc
 * @license     http://www.apache.org/licenses/LICENSE-2.0 
 */

namespace Como\Http;

use \Como\Http\ParameterContainer;

class Request
{
    public $query;

    public $request;

    public $server;

    public function __construct(array $get = array(), array $post = array(), array $server = array())
    {
        $this->query    = new ParameterContainer($get);
        $this->request  = new ParameterContainer($post);
        $this->server   = new ParameterContainer($server);
    }
    
    /**
     * initializeFromGlobals 
     * 
     * @static
     * @access public
     * @return Request
     */
    public static function initializeFromGlobals()
    {
        return new static($_GET, $_POST, $_SERVER);
    }
    
    public function isXmlHttpRequest()
    {
        return strtolower($this->server->get('HTTP_X_REQUEST_WITH')) === 'xmlhttprequest';
    }
    
    
}










/*
 * End of file Request.php
 */

