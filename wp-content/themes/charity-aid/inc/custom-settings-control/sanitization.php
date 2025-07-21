<?php

function charity_aid_sanitize_on_off( $charity_aid_input ) {
	if ( true === $charity_aid_input ) {
		return true;
	} else {
		return false;
	}
}