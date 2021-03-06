<?php namespace App\Modules\Session\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class SessionMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Session::dashboard.menu.session.root'), '#')
		        ->icon('object-ungroup')
		        ->prependIcon();
		  $module->add(trans('Session::dashboard.menu.session.all'), ['route' => 'dashboard.session.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
