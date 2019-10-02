<?php

namespace test;

class Controller
{
	protected $tpl;
	protected $req;

	public function __construct()
	{
		$this->tpl = S('Template');
		$this->req = S('Request');
		$action = $this->req->getDir(0);

        $isAction = $this->isAction($action);
        if ($isAction) {
            $this->tpl->setGlob('baseurl', '');
        }
        if (!$isAction) {
            $this->tpl->setGlob('baseurl', "/$action");
        }

		session_start();

		$this->_performChecks();
	}

	protected function _subscribe()
	{
		$_SESSION['subs'] = 1;
	}

	protected function _unsubscribe()
	{
		$_SESSION['subs'] = 0;
	}

	private function _isSubscribed()
	{
		return isset($_SESSION['subs']) ? $_SESSION['subs'] : 0;
	}

	private function _performChecks()
	{
		$action = S('Request')->getDir(0);

        $isAction = $this->isAction($action);
        if (!$isAction) {
            $action = S('Request')->getDir(1);
        }

		if( !$this->_isSubscribed() && ($action != 'subscribe') )
		{
			Response::redirect('/subscribe');
		}
	}

    /**
     * Проверяем что есть соответствующий экшен
     *
     * @param $action
     *
     * @return bool
     */
    private function isAction($action): bool
    {
        $isEmpty = empty($action);
        if ($isEmpty) {
            $result = true;
        }
        if (!$isEmpty) {
            $current = static::class;

            $parts = explode(Loader::GLUE, $current);
            $last = count($parts) - 1;
            $parts[$last] = $action;
            $target = implode(Loader::GLUE, $parts);

            $result = Loader::isAllowable($target);
        }

        return $result;
    }
}
