<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
	public function index()
	{
		$session = session();
        $locale = service('request')->getLocale();
        $session->remove('lang');
        $session->set('lang',$locale);
        $agent = $this->request->getUserAgent();
        $ref = $agent->getReferrer();
        // return redirect()->back();
        if($ref == base_url().'/') return redirect()->route('/');
        return redirect()->back();
	}
}
