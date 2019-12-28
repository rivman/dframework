<?php

namespace dFramework\dependencies\others\dumpr\Node;

use dFramework\dependencies\others\dumpr\Node;

class String0 extends Node {
	public function chk_ref() {
		return false;
	}

	public function get_len() {
		return strlen($this->raw);
	}

	public function html_css_class($vis, $expand) {
		$class = parent::html_css_class($vis, $expand);

		if (preg_match('/\t| /m', substr($this->raw, 0, 1)))
			$class[] = 'leadspc';
		if (preg_match('/\t| /m',  substr($this->raw, -1)))
			$class[] = 'trailspc';

		return $class;
	}
}