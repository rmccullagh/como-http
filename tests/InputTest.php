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

use \Como\Http\Input;

class InputTest extends PHPUnit_Framework_TestCase
{
    public function testGetReturnNullWhenArray()
    {      
        $_GET['q'] = array();

        $this->assertNull(Input::get('q', Input::FILTER_ARRAY));

    }
    public function testGetReturnDefaultWhenArray()
    {
        $_GET['q'] = array();

        $this->assertEquals('default', 
            Input::get('q', Input::FILTER_ARRAY, $default = 'default')
        );
    }
    public function testGetReturnArray()
    {
        $_GET['q'] = array();

        $this->assertInternalType(
            'array', 
            Input::get('q', Input::NO_FILTER_ARRAY, $default = 'default')
        );
    
    }
    public function testGetReturnNullWhenNull()
    {
        $this->assertNull(Input::get('q'));
    }

    public function testPostReturnNullWhenArray()
    {      
        $_POST['q'] = array();

        $this->assertNull(Input::post('q', Input::FILTER_ARRAY));

    }
    public function testPostReturnDefaultWhenArray()
    {
        $_POST['q'] = array();

        $this->assertEquals('default', 
            Input::post('q', Input::FILTER_ARRAY, $default = 'default')
        );
    }
    public function testPostReturnArray()
    {
        $_POST['q'] = array();
        $this->assertInternalType(
            'array', 
            Input::post('q', Input::NO_FILTER_ARRAY, $default = 'default')
        );
    
    }
    public function testPostReturnNullWhenNull()
    {
        $this->assertNull(Input::post('q'));
    }

    public function testIsAjaxReturnTrue()
    {
        $this->assertTrue(
            Input::is_ajax()
        );
    }

    public function testIsAjaxReturnFalse()
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = NULL;
        
        $this->assertFalse(
            Input::is_ajax()  
        );
    }
}










/*
 * End of file InputTest.php
 */

