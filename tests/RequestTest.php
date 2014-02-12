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

use \Como\Http\Request;

class RequestTest extends PHPUnit_Framework_TestCase
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function testInitializeRequestFromGlobals()
    {
        $this->assertInstanceOf('\Como\Http\Request', Request::initializeFromGlobals());
    }

    public function testGetAllReturnsArray()
    {
        $request = Request::initializeFromGlobals();
        $this->assertInternalType('array', $request->query->getAll());
        $this->assertInternalType('array', $request->request->getAll());
        $this->assertInternalType('array', $request->server->getAll());
    }
    public function testReturnDefaultStringWhenIsArrayAndDenyArrayFlagIsOn()
    {
        $_GET['a']      = array();
        $_POST['a']     = array();
        $_SERVER['a']   = array();
        $def            = 'default';
        $request = Request::initializeFromGlobals();
        $this->assertEquals($def, $request->query->get('a', $def, 0));
        $this->assertEquals($def, $request->request->get('a', $def, 0));
        $this->assertEquals($def, $request->server->get('a', $def, 0));
    }
    
    public function testReturnArrayWhenIsArrayAndDenyArrayFlagIsOff()
    { 
        $_GET['a']      = array();
        $_POST['a']     = array();
        $_SERVER['a']   = array();
        $def            = 'array';
        $request = Request::initializeFromGlobals();
        $this->assertInternalType($def, $request->query->get('a', $def, 1));
        $this->assertInternalType($def, $request->request->get('a', $def, 1));
        $this->assertInternalType($def, $request->server->get('a', $def, 1));
    }
    public function testIsIterable()
    { 
        $_GET['adfaf'] = 'adfaf';
        $request = Request::initializeFromGlobals();
        $this->assertInstanceOf('\IteratorAggregate', $request->query);
        $this->assertInstanceOf('\IteratorAggregate', $request->server);
        $this->assertInstanceOf('\IteratorAggregate', $request->request);
    }

    public function testIsCountable()
    { 
        $request = Request::initializeFromGlobals();
        $this->assertInstanceOf('\Countable', $request->query);
        $this->assertInstanceOf('\Countable', $request->server);
        $this->assertInstanceOf('\Countable', $request->request);
    }

    public function testSetAllowedKeys()
    {
        $_GET = array(
            "dirty" => array(
                "more" => "adfa"
            ), 
            "raw" => "hello", 
            "Good" => "Test", 
            "Test" => "adfa"
        ); 

        $allowed = array_fill_keys(array(
            "Good", 
            "Test"
        ), '');

        $request = Request::initializeFromGlobals();

        $request->query->setAllowedKeys(array(
            "Good", 
            "Test"
        ))->filterAll();

        $this->assertEquals($request->query->getKeys(), array("Good", "Test"));

        foreach($request->query->getKeys() as $key => $value) {
            $this->assertTrue(array_key_exists($value, $allowed));
            $this->assertInternalType('string', 
                $request->query->get(
                    $value, 
                    '', 
                    0
                )
            );
        }
    }
}










/*
 * End of file RequestTest.php
 */

