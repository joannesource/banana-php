<?php
#
# BananaPHP : Write quick syntax PHP code directly in PHP.
#
# https://github.com/joannesource/banana-php
#

set_exception_handler('banana_exception_handler');
set_error_handler("banana_error_handler");

function banana_error_handler($errno, $errstr, $errfile, $errline)
{
	preg_match('/Failed opening \'([^\']+)\'/', $errstr, $matches);
	if(!empty($matches[1]))
		banana($matches[1], 1);
}

function banana_exception_handler($exception) {
	preg_match('/^Call to undefined function ([^\(]+)\(\)/', $exception->getMessage(), $matches);
	if(!empty($matches[1]))
		banana($matches[1], 1);
}


function b($code)
{
	return banana($code);
}

function banana($code, $exec)
{
        $lines = '';
        foreach(explode(PHP_EOL, $code) as $i => $row)
        {

		$strings = null;
		preg_match_all('/"([^"]+)"/', $row, $strings);

		if(!empty($strings[1][0]))
			$prepared = preg_replace('/"([^"]+)"/', '!!STR!!',$row);
		else
			$prepared = $row;

                $els = explode(' ', $prepared);
                $expanded = implode('(', $els) . str_repeat(')', count($els)-1).';'.PHP_EOL;


		if(!empty($strings[1][0]))
			$expanded = str_replace('!!STR!!', '"'.$strings[1][0].'"', $expanded);

		$lines .= $expanded;
        }

#        echo $lines;
#       echo "\n\n";
	if($exec)
        	eval($lines);
	else
		return $lines;
}

