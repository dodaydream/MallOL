<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-navbar-fixed-top">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-badge@3.0.1/dist/css/bulma-badge.min.css">

        <!-- Styles -->
        <!--link href="{{ asset('css/app.css') }}" rel="stylesheet"-->

        <style>
        .custom .dropdown-content {
            padding: 0 !important;
        }
        </style>

<style>

.pagination{height:36px;margin:0;padding: 0;}
.pager,.pagination ul{margin-left:0;*zoom:1}
.pagination ul{padding:0;display:inline-block;*display:inline;margin-bottom:0;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:0 1px 2px rgba(0,0,0,.05);box-shadow:0 1px 2px rgba(0,0,0,.05)}
.pagination li{display:inline}
.pagination a{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0}
.pagination .active a,.pagination a:hover{background-color:#f5f5f5;color:#94999E}
.pagination .active a{color:#94999E;cursor:default}
.pagination .disabled a,.pagination .disabled a:hover,.pagination .disabled span{color:#94999E;background-color:transparent;cursor:default}
.pagination li:first-child a,.pagination li:first-child span{border-left-width:1px;-webkit-border-radius:3px 0 0 3px;-moz-border-radius:3px 0 0 3px;border-radius:3px 0 0 3px}
.pagination li:last-child a{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0}
.pagination-centered{text-align:center}
.pagination-right{text-align:right}
.pager{margin-bottom:18px;text-align:center}
.pager:after,.pager:before{display:table;content:""}
.pager li{display:inline}
.pager a{display:inline-block;padding:5px 12px;background-color:#fff;border:1px solid #ddd;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}
.pager a:hover{text-decoration:none;background-color:#f5f5f5}
.pager .next a{float:right}
.pager .previous a{float:left}
.pager .disabled a,.pager .disabled a:hover{color:#999;background-color:#fff;cursor:default}
.pagination .prev.disabled span{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:1}
.pagination .next.disabled span{float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0}
.pagination li.active, .pagination li.disabled {
	float:left;padding:0 12px;line-height:30px;text-decoration:none;border:1px solid #ddd;border-left-width:0
}
.pagination li.active {
	background: #364E63;
	color: #fff;
}
.pagination li:first-child {
	    border-left-width: 1px;
}
</style>

    </head>
    <body>
        <div id="app">
            <b-navbar class="container" fixed-top>
                <template slot="brand">
                    <b-navbar-item tag="a" href="/">
                        <b-icon icon="shopping"></b-icon>
                        <span>{{ config('app.name', 'Laravel') }}</span>
                    </b-navbar-item>
                </template>
                <template slot="start">
                </template>

                <template slot="end">
                    <b-navbar-item tag="div">
                        <b-field>
                            <b-input placeholder="Search..."
                                type="search"
                                icon="magnify"
                                icon-clickable
                                >
                            </b-input>
                        </b-field>
                    </b-navbar-item>
                    <b-navbar-item tag="div">
                        <div class="buttons">
@guest

<a class="button" href="/login">Log in</a>
<a class="button" href="/register">Register</a>
@else
                            <b-dropdown aria-role="list" hoverable position="is-bottom-left">
                                <button class="button is-white" slot="trigger">
                                    <b-icon icon="account"></b-icon>
                                </button>

                                <b-dropdown-item aria-role="listitem" has-link><a href="/user">{{ Auth::user()->name }}</a></b-dropdown-item>
                                <b-dropdown-item aria-role="listitem" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</b-dropdown-item>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" ref="logoutfrm">
                                        @csrf
                                    </form>

                                <b-dropdown-item aria-role="listitem" has-link><a href="/orders">Track my orders</a></b-dropdown-item>
                            </b-dropdown>

                            <b-dropdown aria-role="list" hoverable position="is-bottom-left" class="custom">
                                <button class="button has-badge-rounded is-white has-badge-danger" slot="trigger" data-badge="{{ Auth::user()->unreadNotifications()->count() }}">
                                    <b-icon icon="bell"></b-icon>
                                </button>

                                <b-dropdown-item
                                    aria-role="listitem"
                                    custom
                                    paddingless
                                >

                                    <div class="modal-card" style="width:350px;">
                                        <header class="modal-card-head">
                                            <p class="modal-card-title">Notifications</p>
                                        </header>
                                    </div>
                                </b-dropdown-item>

                                <a class="navbar-item " href="https://bulma.io/backers">
                                      <span>
                                        <span class="icon has-text-patreon">
                                          <svg class="svg-inline--fa fa-patreon fa-w-16" aria-hidden="true" data-prefix="fab" data-icon="patreon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M512 194.8c0 101.3-82.4 183.8-183.8 183.8-101.7 0-184.4-82.4-184.4-183.8 0-101.6 82.7-184.3 184.4-184.3C429.6 10.5 512 93.2 512 194.8zM0 501.5h90v-491H0v491z"></path></svg><!-- <i class="fab fa-patreon"></i> -->
                                        </span>
                                        <strong>Patreon Backers</strong>
                                        <br>
                                        Everyone who is supporting Bulma
                                      </span>
                                    </a>

                            </b-dropdown>

                            <b-dropdown aria-role="list" hoverable position="is-bottom-left" class="custom">
                                <button class="button is-white has-badge-rounded" data-badge="{{ Auth::user()->carts()->count() }}" slot="trigger">
                                    <b-icon icon="cart"></b-icon>
                                </button>

                                <b-dropdown-item
                                    aria-role="listitem"
                                    custom
                                    paddingless
                                >

                                    <cart />
                                                                                         </b-dropdown-item>
                            </b-dropdown>
@endguest
                        </div>
                    </b-navbar-item>
                </template>
            </b-navbar>

            <div class="container">
                <div class="modals">
                    <v-dialog/>
                </div>
                <div>
                    <notifications position="bottom right" :duration="2000" />
                </div>
            @yield('content')
            </div>

            <footer class="footer">
                <div class="content has-text-centered">
                    <p>
                        <strong>Mallol</strong>, made by ♥️ 
                    </p>
                </div>
            </footer>

        </div>
    </body>
</html>
