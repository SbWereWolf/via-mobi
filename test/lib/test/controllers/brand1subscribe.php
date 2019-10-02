<?php

namespace test\controllers;
use test\Controller;
use test\Response;

class brand1subscribe extends Controller
{
	public function index()
	{
		if( $this->req->get('yes') )
		{
			$this->_subscribe();
			Response::redirect('/');
		}

		Response::answer($this->tpl->get('subscribe'));
	}
}
