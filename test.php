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


require_once __DIR__ . DIRECTORY_SEPARATOR . 'SplClassLoader.php';

SplClassLoader::autoRegister('Como', __DIR__ . DIRECTORY_SEPARATOR . 'src');

use \Como\Http\Input;

var_dump(Input::get('q', Input::FILTER_ARRAY, $default = 'default value'));

var_dump(Input::get('q', Input::NO_FILTER_ARRAY));

var_dump(Input::post('email', Input::FILTER_ARRAY));

var_dump(Input::post('email', Input::NO_FILTER_ARRAY));

var_dump(Input::ip());

var_dump(Input::user_agent());

var_dump(Input::is_ajax());





/*
 * End of file test.php
 */

