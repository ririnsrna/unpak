<style>
.active {
    color: black;
}
</style>

<div class="sidebar" data-color="purple">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <span style="font-size: 10px; padding-top: 2px; color: white;">
            <i class="fa-solid fa-envelope f-2x"></i>
        </span>
        <p style="font-size: 10px; margin-bottom: 3px; color: white;">{{ __('Pengarsipan-Surat') }}</p>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <p class="ml-3 my-3 text-white" style="color: white, font-size:5px;">Menu Utama</p>
        <ul class="nav">
            <li class="@if (request()->routeIs('home')) active @endif">
                <a href="{{ route('home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <div class="logo">

            </div>
            <p class="ml-3 my-3 text-white" style="color: white, font-size:5px;">Daftar Data</p>
            <li>
                <!-- <a data-toggle="collapse" href="#laravelExamples">
              <i class="fab"></i>
            <p><i  data-feather="inbox"></i>
              {{ __('Surat') }}
              <b class="caret"></b>
            </p>
          </a> -->
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="@if (request()->routeIs('pages.suratmasuk')) active @endif">
                            <a href="{{ route('pages.suratmasuk') }}">
                                <i class="fa-regular fa-envelope fa-5x icon-pojok"></i>
                                <p> {{ __('Surat Masuk') }} </p>
                            </a>
                        <li class="@if (request()->routeIs('pages.suratkeluar')) active @endif">
                            <a href="{{ route('pages.suratkeluar') }}">
                                <i class="fa-regular fa-envelope-open fa-5x icon-pojok"></i>
                                <p> {{ __('Surat Keluar') }} </p>
                            </a>
                        <li class="@if (request()->routeIs('pages.disposisi')) active @endif">
                            <a href="{{ route('pages.disposisi') }}">
                                <i class="fa-regular fa-envelope fa-5x icon-pojok"></i>
                                <p> {{ __('Disposisi') }} </p>
                            </a>
                        </li>
                    </ul>
                </div>
        </ul>
    </div>
</div>
<style>
.active {
    color: black;
}
</style>

<div class="sidebar" data-color="purple">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <span style="font-size: 2em; padding-top: 2px; color: white;">
            <i class="fa-solid fa-envelope f-2x"></i>
        </span>
        <a href="#!" style="font-size: 20px; margin-bottom: 3px; color: white;">{{ __('Pengarsipan-Surat') }}</a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <p class="ml-3 my-3 text-white" style="color: white, font-size:5px;">Menu Utama</p>
        <ul class="nav">
            <li class="@if (request()->routeIs('home')) active @endif">
                <a href="{{ route('home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <div class="logo">

            </div>
            <p class="ml-3 my-3 text-white" style="color: white, font-size:5px;">Daftar Data</p>
            <li>
                <!-- <a data-toggle="collapse" href="#laravelExamples">
              <i class="fab"></i>
            <p><i  data-feather="inbox"></i>
              {{ __('Surat') }}
              <b class="caret"></b>
            </p>
          </a> -->
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="@if (request()->routeIs('pages.suratmasuk')) active @endif">
                            <a href="{{ route('pages.suratmasuk') }}">
                                <i class="fa-regular fa-envelope fa-5x icon-pojok"></i>
                                <p> {{ __('Surat Masuk') }} </p>
                            </a>
                        <li class="@if (request()->routeIs('pages.suratkeluar')) active @endif">
                            <a href="{{ route('pages.suratkeluar') }}">
                                <i class="fa-regular fa-envelope-open fa-5x icon-pojok"></i>
                                <p> {{ __('Surat Keluar') }} </p>
                            </a>
                        <li class="@if (request()->routeIs('pages.disposisi')) active @endif">
                            <a href="{{ route('pages.disposisi') }}">
                                <i class="fa-regular fa-envelope fa-5x icon-pojok"></i>
                                <p> {{ __('Disposisi') }} </p>
                            </a>
                        </li>
                    </ul>
                </div>
        </ul>
    </div>
</div>