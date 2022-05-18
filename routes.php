<?php

return [
    "index" => "HomeController@index",

    "listTopCoins"=>"ApiController@listTopCoins",
    "getBtcAnalyze"=>"AnalyzeController@getCoinAnalyze",
    "getLatestNews"=>"LatestNewsController@getLatestNews",

    // Widgets
    "btc_price_widget"=>"WidgetController@btc_price_widget",
    "try_price_widget"=>"WidgetController@try_price_widget",
    // Tasks
    "runTask" => "TaskController@runTask",
    "checkTask" => "TaskController@checkTask",

    // Hostname Settings
    "get_hostname" => "HostnameController@get",
    "set_hostname" => "HostnameController@set",

    // Systeminfo
    "get_system_info" => "SystemInfoController@get",
    "install_lshw" => "SystemInfoController@install",

    // Runscript
    "run_script" => "RunScriptController@run",

    // TaskView
    "example_task" => "TaskViewController@run"
];
