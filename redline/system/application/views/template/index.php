<?php
    $top_nav_buttons=array(
        array(
            'name'=>'Notifications',
            'icon'=>'flag',
            'url'=>'#',
        ),
        array(
            'name'=>'Messages',
            'icon'=>'inbox',
            // 'icon'=>'comment',
            'url'=>'#',
        ),
        array(
            'name'=>'Calendar',
            'icon'=>'calendar',
            'url'=>'#',
        ),
        array(
            'name'=>'Goals',
            // 'icon'=>'time',
            'icon'=>'ok',
            'url'=>'#',
        ),
        array(
            'name'=>'Favorites',
            'icon'=>'heart',
            // 'icon'=>'star',
            'url'=>'#',
        ),
        array(
            'name'=>'System Administration',
            // 'icon'=>'cog',
            'icon'=>'wrench',
            'url'=>'#',
        ),
        // array(
        //     'name'=>'Sign Out',
        //     'icon'=>'off',
        //     'url'=>'#',
        // ),
    );
?>
<nav id="app-header" class="navbar navbar-appheader navbar-fixed-top">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#" title="Notifications"><span class="glyphicon glyphicon-bell"></span></a></li>
            <li><a href="#" title="Messages"><span class="glyphicon glyphicon-inbox"></span></a></li>
            <li><a href="#" title="Calendar"><span class="glyphicon glyphicon-calendar"></span></a></li>
            <li><a href="#" title="Goals"><span class="glyphicon glyphicon-ok"></span></a></li>
            <li><a href="#" title="Favorites"><span class="glyphicon glyphicon-heart"></span></a></li>
            <li><a href="#" title="System Administration"><span class="glyphicon glyphicon-wrench"></span></a></li>
            <li class="dropdown">
                <a href="#" class="avatar dropdown-toggle" data-toggle="dropdown" role="button"><img src="/assets/img/template/avatar.png" /> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <?php for($i=1;$i<=5;$i++): ?>
                    <li><a href="#">Item <?php echo $i ?></a></li>
                <?php endfor; ?>
                </ul>
            </li>
            <li><a href="#" title="Sign Out"><span class="glyphicon glyphicon-off"></span></a></li>
        </ul>
    </div>
</nav>
<nav id="app-nav">
    <div class="logo">
        <a href="#"><img src="/assets/img/template/redline-dark.png" class="img-responsive" /></a>
    </div>
    <ul class="nav nav-stacked">
        <li><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
        <li><a href="#leads-nav" class="collapsed" data-toggle="collapse" data-parent="#app-nav"><span class="glyphicon glyphicon-flag"></span> Leads <span class="caret"></span></a>
            <ul id="leads-nav" class="nav nav-stacked collapse">
            <?php for($i=1;$i<=4;$i++): ?>
                <li><a href="#">Leads Action <?php echo $i ?></a></li>
            <?php endfor; ?>
            </ul>
        </li>
        <li><a href="#inventory-nav" class="collapsed" data-toggle="collapse" data-parent="#app-nav"><span class="glyphicon glyphicon-barcode"></span> Inventory</a>
            <ul id="inventory-nav" class="nav nav-stacked collapse">
            <?php for($i=1;$i<=4;$i++): ?>
                <li><a href="#">Inventory Action <?php echo $i ?></a></li>
            <?php endfor; ?>
            </ul>
        </li>
        <li><a href="#customers-nav" class="collapsed" data-toggle="collapse" data-parent="#app-nav"><span class="glyphicon glyphicon-user"></span> Customers</a>
            <ul id="customers-nav" class="nav nav-stacked collapse">
            <?php for($i=1;$i<=4;$i++): ?>
                <li><a href="#">Customers Action <?php echo $i ?></a></li>
            <?php endfor; ?>
            </ul>
        </li>
        <li><a href="#sales-nav" class="collapsed" data-toggle="collapse" data-parent="#app-nav"><span class="glyphicon glyphicon-credit-card"></span> Sales</a>
            <ul id="sales-nav" class="nav nav-stacked collapse">
            <?php for($i=1;$i<=4;$i++): ?>
                <li><a href="#">Sales Action <?php echo $i ?></a></li>
            <?php endfor; ?>
            </ul>
        </li>
        <li><a href="#reporting-nav" class="collapsed" data-toggle="collapse" data-parent="#app-nav"><span class="glyphicon glyphicon-stats"></span> Reporting</a>
            <ul id="reporting-nav" class="nav nav-stacked collapse">
            <?php for($i=1;$i<=4;$i++): ?>
                <li><a href="#">Reporting Action <?php echo $i ?></a></li>
            <?php endfor; ?>
            </ul>
        </li>
    </ul>
</nav>
<main id="app-content">
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $this->load->view('template/asides/lipsum',array(
                'word_count'=>250,
            )) ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php $this->load->view('template/asides/lipsum',array(
                'word_count'=>100,
            )) ?>
        </div>
    </div>
</main>