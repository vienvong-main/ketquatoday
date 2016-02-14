<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <meta name="viewport" content="width=device-width">
        <title><?php echo (!empty($this->title))?$this->title:BASENAME?></title>
        <link rel="stylesheet" type="text/css" href='/assets/lib/fontawesome/css/font-awesome.min.css'>
        <link rel="stylesheet" type="text/css" href='/assets/lib/jquery-ui/jquery-ui.min.css'>
        <link rel="stylesheet" type="text/css" href='/assets/lib/jquery-ui/jquery-ui.structure.min.css'>
        <link rel="stylesheet" type="text/css" href='/assets/lib/jquery-ui/jquery-ui.theme.min.css'>
        <link rel="stylesheet" type="text/css" href='/assets/css/main.css'>
    </head>
    <body>
        <header>
            <div id='header-promotion'>
                <div class="container header-container fixed-width"></div>
            </div>
            <div id='header-menu'>
                <div class="container header-container fixed-width">
                    <nav class='nav-row'>
                        <ul>
                            <a href="/"><li>Xổ số Miền Bắc </li></a>
                            <li><span class='bulkhead'></span></li>
                            <a href="/home/listdate"><li class="active">Sổ kết quả</li></a>
                            <li><span class='bulkhead'></span></li>
                            <a href="/home/statistic"><li>Thống kê lô tô</li></a>
                            <li><span class='bulkhead'></span></li>
                            <a href=""><li>Liên hệ</li></a>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <div id='main-menu' class="left">
                    <div class="row">
                        <nav class='nav-col left fixed-width'>
                            <div class='nav-header text-left'>
                                <b>Xổ số hôm nay</b>
                            </div>
                            <div class='nav-content row'>
                                <ul>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class="active" ><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class=""><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class=""><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div id='main-content' class="left">
                    <?php echo $ViewContentHTML;?>
                </div>
                <div id='main-suggest' class="left">
                    <div class="row">
                        <nav class='nav-col left fixed-width'>
                            <div class='nav-header text-left'>
                                <b>Xổ số hôm nay</b>
                            </div>
                            <div class='nav-content row'>
                                <ul>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class="active" ><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class=""><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Xổ số Miền Bắc </li></a>
                                    <a href=""><li class=""><i class='fa fa-caret-right'></i> Sổ kết quả</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Thống kê lô tô</li></a>
                                    <a href=""><li><i class='fa fa-caret-right'></i> Liên hệ</li></a>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div id='main-branding' class="left"></div>
            </div>
        </main>
        <footer>
            
        </footer>
        <div id='loader-js' hidden>
            <script type="text/javascript" src="/assets/lib/jquery/jquery-2.1.4.min.js"></script>
            <script type="text/javascript" src="/assets/lib/jquery-ui/jquery-ui.min.js"></script>
            <script type="text/javascript" src='/assets/js/active.js'></script>
        </div>
    </body>
</html>

