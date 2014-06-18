<?php
require 'libs/Utils/Misc.class.php';
require 'libs/Utils/Config.class.php';
$Config = new Config();
$update = $Config->checkUpdate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>eZ Server Monitor - <?= Misc::getHostname(); ?></title>
    <link rel="stylesheet" href="web/css/utilities.css" type="text/css">
    <link rel="stylesheet" href="web/css/frontend.css" type="text/css">
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/plugins/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="js/plugins/jquery.knob.js" type="text/javascript"></script>
    <script src="js/esm.js" type="text/javascript"></script>
    <script>
    $(function(){
        $('.gauge').knob({
            'fontWeight': 'normal',
            'format' : function (value) {
                return value + '%';
            }
        });

        $('a.reload').click(function(e){
            e.preventDefault();
        });

        esm.getAll();
    });
    </script>
</head>
<body>


<nav role="main">
    <div id="appname">
        <a href="index.php"><span class="icon-gauge"></span>eSM</a>
        <a href="<?= $Config->get('esm:website'); ?>"><span class="subtitle">eZ Server Monitor - v<?= $Config->get('esm:version'); ?></span></a>
    </div>

    <div id="hostname">
        <?= Misc::getHostname(); ?> - <?= Misc::getLanIP(); ?>
    </div>

    <?php if (!is_null($update)): ?>
        <div id="update">
            <a href="<?= $update['fullpath']; ?>">New version available (<?= $update['availableVersion']; ?>) ! Click here to download</a>
        </div>
    <?php endif; ?>

    <ul>
        <li><a href="#" class="reload" onclick="esm.reloadBlock('all');"><span class="icon-cycle"></span></a></li>
    </ul>
</nav>


<div id="main-container">

    <div class="box column-left" id="esm-system">
        <div class="box-header">
            <h1>System</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('system');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td>Hostname</td>
                        <td id="system-hostname"></td>
                    </tr>
                    <tr>
                        <td>OS</td>
                        <td id="system-os"></td>
                    </tr>
                    <tr>
                        <td>Kernel version</td>
                        <td id="system-kernel"></td>
                    </tr>
                    <tr>
                        <td>Uptime</td>
                        <td id="system-uptime"></td>
                    </tr>
                    <tr>
                        <td>Last boot</td>
                        <td id="system-last_boot"></td>
                    </tr>
                    <tr>
                        <td>Current user(s)</td>
                        <td id="system-current_users"></td>
                    </tr>
                    <tr>
                        <td>Server datetime</td>
                        <td id="system-server_date"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box column-right" id="esm-load_average">
        <div class="box-header">
            <h1>Load Average</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('load_average');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content t-center">
            <div class="f-left w180">
                <h3>1 min</h3>
                <input type="text" class="gauge" id="load-average_1" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>

            <div class="f-right w180">
                <h3>15 min</h3>
                <input type="text" class="gauge" id="load-average_15" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>

            <div class="t-center" style="margin: 0 180px;">
                <h3>5 min</h3>
                <input type="text" class="gauge" id="load-average_5" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
            </div>
        </div>
    </div>



    <div class="box column-right" id="esm-cpu">
        <div class="box-header">
            <h1>CPU</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('cpu');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td>Model</td>
                        <td id="cpu-model"></td>
                    </tr>
                    <tr>
                        <td>Cores #</td>
                        <td id="cpu-num_cores"></td>
                    </tr>
                    <tr>
                        <td>CPU Speed</td>
                        <td id="cpu-frequency"></td>
                    </tr>
                    <tr>
                        <td>Cache L2</td>
                        <td id="cpu-cache"></td>
                    </tr>
                    <tr>
                        <td>Bogomips</td>
                        <td id="cpu-bogomips"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <div class="box column-left" id="esm-network">
        <div class="box-header">
            <h1>Network usage</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('network');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table>
                <thead>
                    <tr>
                        <th class="w15p">Interface</th>
                        <th class="w20p">IP</th>
                        <th>Receive</th>
                        <th>Transmit</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>


    <div class="cls"></div>



    <div class="box" id="esm-disk">
        <div class="box-header">
            <h1>Disk usage</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('disk');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table>
                <thead>
                    <tr>
                        <th class="w20p">Mount</th>
                        <th class="w35p">Use</th>
                        <th class="w15p">Free</th>
                        <th class="w15p">Used</th>
                        <th class="w15p">Total</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>




    <div class="box column-left" id="esm-memory">
        <div class="box-header">
            <h1>Memory</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('memory');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td class="w20p">Used RAM</td>
                        <td><div class="progressbar-wrap"><div class="progressbar" style="width: 0%;">0%</div></div></td>
                    </tr>
                    <tr>
                        <td class="w20p">Used RAM</td>
                        <td id="memory-used"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Free RAM</td>
                        <td id="memory-free"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Total RAM</td>
                        <td id="memory-total"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box column-right" id="esm-swap">
        <div class="box-header">
            <h1>Swap</h1>
            <ul>
                <li><a href="#" class="reload" onclick="esm.reloadBlock('swap');"><span class="icon-cycle"></span></a></li>
            </ul>
        </div>

        <div class="box-content">
            <table class="firstBold">
                <tbody>
                    <tr>
                        <td class="w20p">Used Swap</td>
                        <td><div class="progressbar-wrap"><div class="progressbar" style="width: 0%;">0%</div></div></td>
                    </tr>
                    <tr>
                        <td class="w20p">Used Swap</td>
                        <td id="swap-used"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Free Swap</td>
                        <td id="swap-free"></td>
                    </tr>
                    <tr>
                        <td class="w20p">Total Swap</td>
                        <td id="swap-total"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="cls"></div>


    <div class="t-center">
        <div class="box column-left column-33" id="esm-last_login">
            <div class="box-header">
                <h1>Last login</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('last_login');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <table>
                    <tbody></tbody>
                </table>
            </div>
        </div>



        <div class="box column-right column-33" id="esm-services">
            <div class="box-header">
                <h1>Services status</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('services');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <table>
                    <tbody></tbody>
                </table>
            </div>
        </div>




        <div class="box t-center" style="margin: 0 33%;" id="esm-ping">
            <div class="box-header">
                <h1>Ping</h1>
                <ul>
                    <li><a href="#" class="reload" onclick="esm.reloadBlock('ping');"><span class="icon-cycle"></span></a></li>
                </ul>
            </div>

            <div class="box-content">
                <table>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

    

    <div class="cls"></div>

</div>



</body>
</html>