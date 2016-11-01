<?php
// Prepared menu new.
$menuNew = '
    <span class="panel-dropdown-items"><a href="' . $uri->write_note . '">Write new note</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->create_page . '">Create new page</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->build_controller . '">Build new controller</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->register_route . '">Register new route</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->add_layout . '">Add new layout</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->insert_meta . '">Insert new meta</a></span>
 ';
// Prepared menu tools.
$menuTools = '
    <span class="panel-dropdown-items"><a href="' . $uri->landing . '">Landing template</a></span>
    <span class="panel-dropdown-items"><a href="' . $uri->assets_management . '">Assets management</a></span>
 '; ?>



<style media="screen">
    #panel {
        width: 100%;
        background: rgb(240, 240, 240);
        border-bottom: 1px solid rgb(222, 222, 222);
        position: fixed;
        font-size: 14px;
        z-index: 999;
    }
    #panel a, .panel-link {
        color: rgb(90, 90, 90);
        font-weight: bold;
        font-size: 13px;
        cursor: pointer;
    }
    #panel a:hover, .panel-link:hover {
        color: rgb(0, 0, 0);
        text-decoration: none;
    }
    #panel-inner {
        width: 1000px;
        height: 40px;
        margin: auto;
        display: flex;
    }
    #panel-inner-left {
        width: 100%;
        display: block;
        padding: 10px;
    }
    #panel-inner-right {
        width: 100%;
        display: block;
        text-align : right;
        padding: 10px;
    }
    #panel-martabak-logo {
        width: 25px;
        height: 25px;
        margin: -2px 15px -7px 8px;
        opacity: 0.5;
        transition: all 0.5s;
    }
    #martabak-logo:hover {
        opacity: 1;
    }
    #panel-tools-dropdown, #panel-new-dropdown, #panel-menu-dropdown {
        padding: 0 10px;
        background: rgb(255, 255, 255);
        border: 1px solid rgb(222, 222, 222);
        position: absolute;
        text-align: left;
    }
    #panel-new-dropdown {
        width: 170px;
        margin: 11px 0 0 -20px;
    }
    #panel-tools-dropdown {
        margin: 11px 0 0 -100px;
        width: 170px;
    }
    #panel-tools-dropdown a, #panel-new-dropdown a {
        font-weight: normal;
    }
    #panel-right-min {
        display: none;
        visibility: hidden;
    }
    .panel-link {
        margin: 0 10px;
    }
    .panel-link-left {
        float: left;
    }
    .panel-link-right {
        float: right;
    }
    .panel-dropdown-items {
        display: block;
        margin: 15px 0;
    }
    .panel-menu-item-dropdown {
        margin-left: 16px;
    }
    .panel-dropdown-menu {
        display: none;
        visibility: hidden;
    }
    @media only screen and (max-width: 1015px)
    {
        #panel-inner {
            width: 100%;
        }
    }
    @media only screen and (max-width: 620px)
    {
        #panel a, .panel-link {
            color: rgb(120, 120, 120);
        }
        .panel-link a i.fa, #panel-tools, #new-drop {
            font-size: 15px;
        }
        .panel-link-text {
            display: none;
        }
        #panel-tools, #panel-new {
            margin-top: -1px;
        }
        #panel-tools-dropdown, #panel-new-dropdown {
            margin-top: 9px;
        }
        #panel-tools-dropdown span a, #panel-new-dropdown span a {
            font-size: 13px;
        }
    }
    @media only screen and (max-width: 400px)
    {
        #panel {
            position: relative;
        }
        #panel-right-full, #panel-left-full {
            display: none;
            visibility: hidden;
        }
        #panel-right-min {
            display: block;
            visibility: visible;
        }
        #panel-menu-dropdown {
            width: 100%;
            margin: 14px 0 0;
            left: 1px;
            box-sizing: border-box;
        }
    }
    @media only screen and (max-width: 210px)
    {
        #panel-inner-left {
            display: none;
            visibility: hidden;
        }
    }
</style>



<div id="panel">
    <div id="panel-inner">
        <div id="panel-inner-left">
            <img id="panel-martabak-logo" class="panel-link-left" src="<?php echo $path->main_assets; ?>/images/martabak.png" alt="Martabak Logo 2016">
            <div id="panel-left-full">
                <span class="panel-link panel-link-left" title="Visit your site"><a href="/"><i class="fa fa-globe" aria-hidden="true"></i> <span class="panel-link-text">Site</span></a></span>
                <span class="panel-link panel-link-left"><a href="<?php echo $uri->backend; ?>"><i class="fa fa-home" aria-hidden="true"></i> <span class="panel-link-text">Dashboard</span></a></span>
                <div id="panel-new" class="panel-link panel-link-left">
                    <span id="new-drop">
                        <i class="new-drop fa fa-plus" aria-hidden="true"></i>
                        <i class="new-drop fa fa-caret-down" aria-hidden="true"></i>
                    </span>
                    <div id="panel-new-dropdown" class="panel-dropdown-menu">
                        <?php echo $menuNew; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel-inner-right">
            <div id="panel-right-full">
                <span class="panel-link panel-link-right"><a href="<?php echo $uri->logout; ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="panel-link-text">Log out</span></a></span>
                <span class="panel-link panel-link-right"><a href="<?php echo $uri->settings; ?>"><i class="fa fa-wrench" aria-hidden="true"></i> <span class="panel-link-text">Settings</span></a></span>
                <div id="panel-tools" class="panel-link panel-link-right">
                    <span id="tools-drop"><i class="fa fa-caret-down" aria-hidden="true"></i> Tools</span>
                    <div id="panel-tools-dropdown" class="panel-dropdown-menu">
                        <?php echo $menuTools; ?>
                    </div>
                </div>
            </div>
            <div id="panel-right-min" class="">
                <div id="panel-menu" class="panel-link panel-link-right">
                    <span id="menu-drop"><i class="fa fa-caret-down" aria-hidden="true"></i> Menu</span>
                    <div id="panel-menu-dropdown">
                        <span class="panel-dropdown-items"><a href="/"><i class="new-drop fa fa-globe" aria-hidden="true"></i> Visit Site</a></span>
                        <span class="panel-dropdown-items"><a href="<?php echo $uri->backend; ?>"><i class="new-drop fa fa-home" aria-hidden="true"></i> Dashboard</a></span>
                        <div id="panel-menu-add" class="panel-dropdown-items panel-link">
                            <span id="menu-add-drop"><i class="new-drop fa fa-plus" aria-hidden="true"></i> New <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                            <div id="panel-menu-add-dropdown" class="panel-dropdown-menu panel-menu-item-dropdown">
                                <?php echo $menuNew; ?>
                            </div>
                        </div>
                        <div id="panel-menu-tools" class="panel-dropdown-items panel-link">
                            <span id="menu-tools-drop"><i class="new-drop fa fa-chevron-circle-right" aria-hidden="true"></i> Tools <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                            <div id="panel-menu-tools-dropdown" class="panel-dropdown-menu panel-menu-item-dropdown">
                                <?php echo $menuTools; ?>
                            </div>
                        </div>
                        <span class="panel-dropdown-items"><a href="<?php echo $uri->settings; ?>"><i class="new-drop fa fa-wrench" aria-hidden="true"></i> Settings</a></span>
                        <span class="panel-dropdown-items"><a href="<?php echo $uri->logout; ?>"><i class="new-drop fa fa-sign-out" aria-hidden="true"></i> Log Out</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    Petis('#tools-drop').dropDown({event: 'click', toShowed: '#panel-tools-dropdown'});
    Petis('#new-drop').dropDown({event: 'click', toShowed: '#panel-new-dropdown'});
    Petis('#menu-drop').dropDown({event: 'click', toShowed: '#panel-menu-dropdown'});
    Petis('#menu-add-drop').dropDown({event: 'click', toShowed: '#panel-menu-add-dropdown'});
    Petis('#menu-tools-drop').dropDown({event: 'click', toShowed: '#panel-menu-tools-dropdown'});
</script>
