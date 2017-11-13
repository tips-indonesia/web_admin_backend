<?php

namespace App\Http\Middleware;

use Closure;
use App\MenuList;
use Auth;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('Sidebar', function ($menu) {
            $menuLists = MenuList::all();
            foreach ($menuLists as $menuList) {
                if ($menuList->menu_parent_id == null) {
                    $menu->add($menuList->name, $menuList->url)->id($menuList->id)->data('class', $menuList->class_name);
                } else {
                    if (sizeof(explode('|', $menuList->class_name)) == 1) {
                        $menu->find($menuList->menu_parent_id)->add($menuList->name, route(($menuList->class_name).'index') )->id($menuList->id)->data('class', $menuList->class_name);
                    } else {
                        $menu->find($menuList->menu_parent_id)->add($menuList->name, '#' )->id($menuList->id)->data('class', $menuList->class_name);
                    }
                }
            }

        }); 
        return $next($request);
    }
}
