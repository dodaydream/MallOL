<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-navbar-fixed-top">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">

        <!-- Styles -->
        <!--link href="{{ asset('css/app.css') }}" rel="stylesheet"-->

        <style>
        .custom .dropdown-content {
            padding: 0 !important;
        }
        </style>

    </head>
    <body>
        <div id="app">
            <b-navbar class="container" fixed-top>
                <template slot="brand">
                    <b-navbar-item tag="router-link" :to="{ path: '/' }">
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
                                @icon-click="searchIconClick">
                            </b-input>
                        </b-field>
                    </b-navbar-item>
                    <b-navbar-item tag="div">
                        <div class="buttons">
                            <b-dropdown aria-role="list" hoverable position="is-bottom-left">
                                <button class="button" slot="trigger">
                                    <b-icon icon="account"></b-icon>
                                </button>

                        @guest
                                <b-dropdown-item aria-role="listitem" has-link><a href="/login">Log in</a></b-dropdown-item>
                                <b-dropdown-item aria-role="listitem" has-link><a href="/register">Register</a></b-dropdown-item>
                        @else
                                <b-dropdown-item aria-role="listitem" has-link><a href="/user">{{ Auth::user()->name }}</a></b-dropdown-item>
                                <b-dropdown-item aria-role="listitem" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</b-dropdown-item>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" ref="logoutfrm">
                                        @csrf
                                    </form>
                        @endguest

                                <b-dropdown-item aria-role="listitem">Track my orders</b-dropdown-item>
                            </b-dropdown>

                            <b-dropdown aria-role="list" hoverable position="is-bottom-left" class="custom">
                                <button class="button" slot="trigger">
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
                                <button class="button" slot="trigger">
                                    <b-icon icon="cart"></b-icon>
                                    <b-tag>1</b-tag>
                                </button>

                                <b-dropdown-item
                                    aria-role="listitem"
                                    custom
                                    paddingless
                                >

                                    <cart />
                                                                                         </b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </b-navbar-item>
                </template>
            </b-navbar>

            <div class="container">
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
