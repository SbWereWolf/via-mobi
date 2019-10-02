<?php

namespace test;

class Application extends Singleton
{
	protected $_controllersdir = 'controllers';

	public function run()
	{
		$dirs = S('Request')->getDirs();

        $ownController = '';
		if( count($dirs) && (($dirs[0] == 'brand1') || ($dirs[0] == 'brand2')) )
		{
            $ownController = $dirs[0];
			S('Config')->apply(array_shift($dirs));
		}

		if( !count($dirs) )
		{
			$dirs[] = S('Config')->defaultClass;
		}
        $class = array_shift($dirs);

		if( !count($dirs) )
		{
			$dirs[] = S('Config')->defaultAction;
		}
		$action = array_shift($dirs);
		
		if( !preg_match('#^\w+$#', $class) || !preg_match('#^\w+$#', $action) )
		{
			Response::headerForbidden();
		}

        if ($class === 'subscribe') {
            $class = "$ownController$class";
        }

		$class = __NAMESPACE__ . '\\' . $this->_controllersdir . '\\' . $class;
        $isAllow = Loader::isAllowable($class);
        if ($isAllow) {
            $controller = new $class;
            $isAllow = method_exists($controller, $action);
        }
        if (!$isAllow)
		{
			Response::headerNotFound();
		}
        if ($isAllow) {
            call_user_func_array(array($controller, $action), $dirs);
        }
	}
}
