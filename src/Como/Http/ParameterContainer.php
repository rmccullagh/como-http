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

class ParameterContainer implements \IteratorAggregate, \Countable
{
    protected $parameters = array();

    public function __construct(array $parameters = array())
    {
         $this->parameters = $parameters;
    }

    public function getAll()
    {
        return $this->parameters;
    }

    public function getKeys()
    {
        return array_keys($this->parameters);
    }

    public function setAllowedKeys(array $allowed = array())
    {
        $keys   = array_fill_keys($allowed, '');
        $all    = array_replace($keys, array_intersect_key($this->parameters, $keys));
        $this->parameters = $all;
        return $this;
    }
    
    public function filterAll($callable = 'strlen')
    {
        $this->parameters = array_filter($this->parameters, $callable); 
        return $this;
    }
    public function get($key, $default = null, $allow_return_array = 0)
    {
        if(!isset($this->parameters[$key])) {
            return $default;
        }  
        if(0 === $allow_return_array || false === $allow_return_array) {
            if(is_array($this->parameters[$key])) {
                return $default;
            }
        }
        return $this->parameters[$key];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }

    public function count()
    {
        return count($this->parameters);
    }
}









/*
 * End of file ParameterContainer.php
 */

