<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use \Ds\Set;

class MenuList extends Model
{
    //
    public function getClasses() {
    	if ($this->class_name != '*') {
    		return array($this->class_name);
    	} else {
    		$classes = array();
    		$children = MenuList::where('menu_parent_id', $this->id)->get();
    		foreach ($children as $child) {
    			$class = $child->getClasses();
    			$classes = array_merge($classes, $class);
    		}                                                                                                                                                    
    		return $classes;
    	}
    }
}
