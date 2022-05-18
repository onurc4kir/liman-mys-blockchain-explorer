<?php
namespace App\Controllers;

class RunScriptController
{
	public function run()
	{
        // runScript function
        // 1st parameter: filename under scripts folder STRING
        // 2nd parameter: parameters STRING
        // 3nd parameter: run as sudo BOOL
		$script = runScript("example.py", "", false);

        return $script;
	}
}
