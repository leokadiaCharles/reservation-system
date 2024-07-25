
<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <!-- <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a> -->
                <!-- <strong><a href="index.html"><img src="img/logo/logosn.png" alt="" /></a></strong> -->
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                    <li>

                    <a title="Landing Page"  aria-expanded="false">
                        <span class="fas fa-tachometer-alt" aria-hidden="true"></span>
                        <span class="mini-click-non">Dashboard</span>
                    </a>

                        </li>


                        <li>
                         @role("Administrator")
                        <a title="Landing Page" href="{{ route('hotelViews.tableShow') }}" aria-expanded="false">
                            <span class="fas fa-chair" aria-hidden="true"></span>
                            <span class="mini-click-non">New Table</span>
                        </a>
                    </li>


                    <li>
                        <a title="Landing Page" href="{{ route('hotelViews.venueShow') }}" aria-expanded="false">
                            <span class="fas fa-door-open" aria-hidden="true"></span>
                            <span class="mini-click-non">New Venue</span>
                        </a>
                    </li>



                    <li>
                        <a href="{{ route('hotelViews.newTable') }}" aria-expanded="false">
                            <span class="fa fa-building" aria-hidden="true"></span>
                            <span class="mini-click-non">Hotel</span>
                        </a>
                    </li>
                    @endrole
                    </ul>
                </nav>
            </div>
        </nav>
    </div>

