<div class="sidebar-module" id="sidebar-gear-store">
    <div class="sidebar-title">
        <h3 class="header-3 title-forums"><a href="/community/status">Server Status</a></h3>
    </div>

    <div class="sts a-realm sidebar-container box-shadow">
        <div id="head" class="clearfix text-shadow">
            <p id="name">{{ $server->name }}</p>
            <p id="info">{!! $server->status ? '<font color="green">Online</font>' : '<font color="red">Offline</font>' !!}</p>
        </div>
        <div id="containerbody" class="clearfix text-shadow">
            <p id="online"><font color="#d28010">{{ $online->alliance ?: '0' }}</font> Alliance</p>
            <p id="uptime"><font color="#d28010">{{ $online->horde ?: '0' }}</font> Horde</p>
        </div>
    </div>
    <div class="realmlist realm_cont_show">
        <p><font color="#817464">SET portal "62.173.145.6"</font></p>
    </div>
</div>