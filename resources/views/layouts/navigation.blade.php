<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-dark bg-dernek-acik">
            <div class="container-xl">
                <ul class="navbar-nav">

                    <li class="nav-item @if(request()->routeIs('homepage')) active @endif">
                        <a class="nav-link" href="{{ route('homepage') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Anasayfa') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(request()->routeIs('users.index')) active @endif">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                               <svg fill="white" id="tff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 336.83 400.11"><g id="katman_1"><g><path d="M79.63,0c3.92,1.2,7.77,2.41,11.64,3.57,13.47,4.04,27.12,7.27,41,9.5,10.19,1.64,20.43,2.65,30.77,2.56,3.57-.03,7.14-.01,10.71,0,8.66,.02,17.25-.73,25.81-1.98,18.61-2.73,36.72-7.47,54.53-13.41,1.3-.43,2.1-.31,3.13,.66,19.4,18.28,38.84,36.51,58.27,54.75,4.43,4.16,8.86,8.34,13.31,12.48,.77,.72,1.23,1.5,1.45,2.56,1.95,9.52,3.49,19.1,4.61,28.76,1.32,11.39,2.01,22.81,1.97,34.26-.19,45.9-11.25,89.05-32.93,129.48-15.68,29.24-35.75,55.18-59.27,78.5-21.55,21.37-45.21,40.08-71.22,55.76-1.28,.77-2.6,1.46-3.85,2.27-.8,.52-1.47,.52-2.29,0-1.87-1.17-3.81-2.22-5.68-3.38-42.93-26.61-79.61-59.97-108.91-101.23-17.76-25.01-31.46-52.09-40.56-81.43-4.13-13.34-7.18-26.92-9.23-40.74C.38,156.14-.41,139.24,.19,122.29c.64-17.91,2.98-35.62,6.69-53.15,.21-.97,.77-1.57,1.43-2.18,7.61-7.14,15.21-14.29,22.81-21.43C46.81,30.78,62.49,16.05,78.18,1.31c.48-.45,.96-.88,1.44-1.31ZM40.25,261.85c.41,.8,.68,1.33,.96,1.85,7.68,13.84,16.44,26.96,26.2,39.42,18.19,23.22,39.15,43.62,62.46,61.65,11.75,9.09,23.98,17.47,36.86,24.89,1.17,.67,2.13,.9,3.24,.02,.51-.4,1.13-.65,1.7-.99,36.1-21.52,67.48-48.52,94.06-81.07,20.4-24.99,36.55-52.47,47.54-82.88,8.59-23.75,13.58-48.24,14.9-73.47,.65-12.34,.49-24.68-.5-36.99-.9-11.11-2.48-22.14-4.63-33.08-.1-.51-.28-1-.5-1.75-94.16,60.84-188.18,121.58-282.3,182.4ZM140.41,60.95c-21.21-14.9-54.2-15.87-78.19,4.52-24.53,20.85-29.99,55.69-14.34,82.75,16.01,27.68,49.38,39.8,79.29,28.71,31.48-11.67,43.83-41.6,42.56-62.27-1.3,7.11-3.77,13.75-7.78,19.77-3.98,5.99-9.01,10.93-15.1,14.77-6.14,3.87-12.82,6.25-20,7.23-7.19,.99-14.27,.36-21.2-1.75-25.59-7.79-40.43-34.42-33.63-60.53,3.34-12.79,10.7-22.85,21.98-29.73,14.79-9.03,30.37-9.76,46.41-3.47Zm47.72-16.64c-.16-.05-.31-.1-.47-.15-4.33,4.97-8.67,9.94-13.04,14.95-6.24-2.11-12.23-4.61-18.57-6.34,3.34,5.54,6.69,11.08,10.05,16.64-3.96,5.15-7.83,10.17-11.7,15.19,.08,.11,.16,.23,.23,.34,6.12-1.38,12.23-2.76,18.24-4.12,.18,.13,.25,.15,.28,.2,3.59,5.41,7.17,10.82,10.75,16.23,.1,.15,.23,.27,.35,.4,.03,.03,.11,.04,.16,.04,.05,0,.1-.02,.34-.09,.47-6.68,.94-13.43,1.41-20.2,6.56-1.8,13.07-3.23,19.47-5.04,0-.14,0-.29,0-.43-6.02-2.48-12.05-4.96-18.15-7.47,.21-6.77,.42-13.46,.63-20.16Z"/><path d="M237.41,280.9c-.11,37.75-30.36,68.07-67.96,68.09-37.74,.02-67.99-30.44-67.97-68.04,.02-37.52,30.15-68.04,68.01-68,37.68,.04,67.73,30.38,67.92,67.95Zm-68.16,57.6c5.06,.21,10.12,.38,15.17,.65,1.24,.06,1.91-.33,2.49-1.46,2.99-5.83,6.05-11.62,9.14-17.4,.54-1.02,.55-1.77-.08-2.77-4.56-7.27-9.07-14.56-13.54-21.88-.64-1.04-1.34-1.44-2.57-1.43-7.15,.06-14.3,.06-21.45,0-1.28-.01-2.06,.41-2.8,1.43-4.75,6.56-9.53,13.1-14.37,19.6-.77,1.03-.76,1.77-.15,2.86,3.4,6.01,6.76,12.05,10.03,18.14,.7,1.31,1.56,1.74,2.94,1.77,5.06,.12,10.12,.31,15.18,.48Zm47.38-73.86c-8.69,1.94-17.21,3.86-25.74,5.72-1.07,.23-1.39,.93-1.67,1.82-2.15,6.69-4.29,13.37-6.51,20.04-.4,1.19-.29,2.1,.37,3.15,4.46,7.11,8.86,14.26,13.28,21.4,.34,.55,.7,1.08,1.06,1.63,.41-.05,.7-.06,.98-.14,7-1.9,13.99-3.82,21-5.69,1.05-.28,1.52-.84,1.81-1.88,2.41-8.72,4.88-17.42,7.37-26.11,.3-1.06,.21-1.88-.42-2.82-3.57-5.28-7.07-10.6-10.61-15.9-.26-.39-.56-.75-.92-1.22Zm-76.84,51.15c.34-.39,.63-.69,.88-1.02,4.97-6.77,9.92-13.55,14.92-20.3,.62-.84,.63-1.56,.34-2.46-2.15-6.56-4.3-13.12-6.37-19.7-.37-1.17-1.02-1.71-2.13-2.1-7.45-2.64-14.88-5.35-22.32-8.03-.49-.18-1-.3-1.47-.43-.21,.18-.37,.27-.48,.41-4.03,5.24-8.04,10.49-12.09,15.72-.55,.71-.49,1.36-.3,2.16,2.25,9.43,4.51,18.87,6.67,28.32,.31,1.35,1.01,1.82,2.2,2.13,4.03,1.03,8.04,2.13,12.06,3.2,2.69,.71,5.39,1.41,8.09,2.11Zm76.31-51.84c.03-.54,.07-.83,.06-1.13-.27-6.49-.56-12.97-.79-19.46-.04-1.09-.66-1.56-1.43-2.06-7.77-5.09-15.54-10.17-23.29-15.29-1-.66-1.79-.79-2.92-.23-5.28,2.6-10.6,5.13-15.95,7.6-1.2,.55-1.64,1.22-1.66,2.54-.08,5.96-.24,11.91-.45,17.86-.04,1.1,.38,1.74,1.22,2.35,5.94,4.28,11.87,8.58,17.77,12.92,.85,.62,1.62,.75,2.64,.51,5.09-1.19,10.2-2.3,15.31-3.44,3.13-.7,6.25-1.43,9.47-2.17Zm-46.74-29.94c-7.22-3.21-14.28-6.34-21.36-9.49-.75,.52-1.44,.98-2.12,1.46-6.27,4.43-12.52,8.9-18.84,13.27-1.26,.87-1.79,1.82-1.88,3.34-.34,5.59-.81,11.17-1.24,16.75-.12,1.53-.15,1.55,1.28,2.07,7.44,2.68,14.89,5.33,22.32,8.04,.97,.35,1.65,.23,2.45-.36,5.95-4.37,11.93-8.71,17.92-13.03,.75-.54,1.07-1.12,1.09-2.06,.1-6.14,.26-12.27,.39-18.41,.01-.47,0-.94,0-1.58Zm-66.29,37.41c-.2,.8-.35,1.18-.39,1.58-.9,8.07-.48,16.06,1.45,23.95,2.41,9.81,6.82,18.64,13.2,26.48,.38,.46,.66,1.12,1.48,1.2,0-.44,.03-.79,0-1.14-.27-2.43-.55-4.85-.84-7.28-.24-2.01-.33-4.06-.78-6.02-2.34-10.03-4.77-20.03-7.19-30.05-.12-.51-.23-1.1-.55-1.48-2-2.35-4.07-4.64-6.37-7.25Zm78.2-56.62c.41,.6,.58,.9,.81,1.15,2.48,2.74,4.96,5.48,7.47,8.19,.44,.47,.98,.87,1.52,1.23,7.91,5.21,15.83,10.41,23.75,15.61,.6,.39,1.21,.77,1.85,1.07,3.02,1.41,6.05,2.8,9.09,4.17,.33,.15,.7,.2,1.42,.4-5.9-9.73-13.41-17.31-22.76-23.05-7.05-4.32-14.63-7.27-23.15-8.77Zm9.04,129.88c-1.15-1.24-2.25-2.32-3.22-3.51-.83-1.01-1.78-1.37-3.08-1.41-5.71-.15-11.42-.42-17.13-.62-4.58-.17-9.16-.32-13.74-.45-.58-.02-1.31-.08-1.72,.22-2.01,1.46-3.94,3.03-5.94,4.61,8.5,5.49,34.31,6.17,44.83,1.16Zm31.1-21.59c7.66-9.05,12.28-19.46,14.31-31.06,1.02-5.87,1.2-14.92,.23-16.63-.37,.42-.73,.8-1.05,1.21-1.44,1.83-2.91,3.63-4.27,5.51-.58,.8-1.06,1.73-1.33,2.67-2.29,7.96-4.37,15.98-6.82,23.88-1.48,4.75-.81,9.56-1.06,14.41Zm-67.17-107.67c-16.9,4.22-30.07,13.25-39.88,27.26,.4,.09,.74,.06,1.06-.03,2.74-.79,5.49-1.55,8.21-2.41,.89-.28,1.76-.73,2.52-1.26,4.49-3.13,8.86-6.45,13.45-9.43,5.2-3.38,9.75-7.38,13.48-12.34,.21-.29,.47-.54,.68-.83,.13-.18,.2-.4,.48-.95Z"/><path d="M253.6,182.44c-.2,1.76-.87,3.15-2.15,4.27-5.76,5.01-14.3,2.04-15.99-5.56-.83-3.74,.08-7.12,2.33-10.12,2.13-2.84,4.95-4.86,8.31-5.95,4.53-1.47,8.63-.46,12.03,2.87,4.16,4.08,5.73,9.13,4.93,14.86-.98,6.93-4.22,12.85-8.53,18.24-.56,.7-1.16,1.36-1.74,2.04-.49,.57-1.03,.51-1.56,.06-.52-.44-.42-.91-.07-1.42,.47-.69,.93-1.39,1.36-2.1,1.9-3.21,3.29-6.59,3.78-10.33,.5-3.85-.18-7.48-1.85-10.94-1.39-2.86-3.25-5.41-5.39-7.76-.52-.57-1.12-1.08-1.75-1.52-1.3-.91-2.66-.95-4.02-.12-1.34,.82-2.03,1.99-1.89,3.58,.05,.53,.14,1.07,.31,1.57,.98,3.06,2.68,5.72,4.88,8.02,1.65,1.72,2.83,1.77,4.65,.23,.84-.71,1.47-.53,2.37,.06Z"/><path d="M296.39,149.48c1.42-.52,2.61-1.08,3.85-1.39,2.92-.73,5.42,.19,7.48,2.28,2.54,2.58,3.02,5.78,2.24,9.14-1.32,5.66-4.65,9.85-9.83,12.5-.93,.48-2.01,.79-3.05,.93-1.84,.26-3.43-.81-3.9-2.42-.44-1.51,.3-3.23,1.77-4.14,.95-.59,1.92-.57,2.89-.09,.9,.45,1.77,.99,2.68,1.43,1.15,.55,1.65,.45,2.56-.45,1.25-1.23,1.65-2.76,1.31-4.43-.58-2.87-1.94-5.39-3.94-7.5-2.96-3.12-5.64-1.59-7.45,.57-.15,.18-.26,.4-.39,.6-.81,1.18-1.11,1.18-2.32-.07,1.09-2.09,2.11-4.25,2.21-6.68,.05-1.12,.01-2.28-.25-3.36-.42-1.73-1.49-3.08-3.34-3.33-1.78-.24-3.09,.81-3.96,2.25-.54,.9-.82,1.97-1.14,2.98-.47,1.47-.61,1.56-2.12,.98-.42-6.93,3.7-11.95,8.28-13.11,2.81-.71,5.38-.16,7.36,2.01,2,2.19,2.29,4.79,1.1,7.49-.55,1.24-1.27,2.41-2.03,3.81Z"/><path d="M274.44,168.39c2.09-1.47,4.2-2.91,6.26-4.42,1.32-.96,1.64-2.39,1.76-3.93,.12-1.59,.2-1.6,1.99-1.48,.53,3,1.06,6.03,1.57,8.96-5.59,3.7-11.13,7.36-16.78,11.09-.96-.32-.83-1.04-.5-1.93,1.05-2.85,2.08-5.7,3.04-8.58,.58-1.75,1.03-3.55,.91-5.43-.09-1.41-.49-2.69-1.39-3.79-1.28-1.56-2.97-1.92-4.78-1.03-1.64,.8-2.77,2.03-3.22,3.83-.2,.81-.36,1.63-.58,2.43-.18,.66-.75,.82-1.27,.63-.36-.13-.86-.6-.86-.91,.09-6.02,1.42-10.92,7.47-13.62,.8-.36,1.7-.61,2.57-.68,5.21-.43,8.85,3.83,7.85,9.13-.52,2.74-1.8,5.16-3.21,7.52-.39,.65-.78,1.29-1.18,1.93,.11,.09,.23,.19,.34,.28Z"/><path d="M239.49,196.06c.34,.51,.67,1.01,1.03,1.54-5.56,3.66-10.95,7.2-16.35,10.75-1.28-1.13-1.29-1.36-.15-2.45,.47-.45,.93-.92,1.42-1.36,.93-.84,1.01-1.84,.52-2.92-.24-.54-.53-1.06-.86-1.56-1.98-3.04-3.98-6.08-5.97-9.11-.26-.4-.55-.78-.85-1.14-.9-1.09-2.01-1.43-3.34-.87-.55,.23-1.11,.43-1.66,.65-1.52,.62-1.68,.54-2.13-1.16,5.39-3.55,10.79-7.09,16.18-10.64,1.23,1.22,1.24,1.35,.21,2.4-2.71,2.77-2.78,3.4-.69,6.59,1.76,2.69,3.54,5.37,5.31,8.04,.33,.5,.67,.99,1.05,1.44,.94,1.12,2.07,1.55,3.49,.91,.81-.36,1.65-.67,2.79-1.12Z"/></g></g></svg>
                            </span>
                            <span class="nav-link-title">
                                Kurullar
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(request()->routeIs('users.index')) active @endif">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.6 512.6" style="enable-background:new 0 0 512.6 512.6;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #FFFFFF;
                                            stroke: #FFFFFF;
                                            stroke-width: 16;
                                            stroke-miterlimit: 10;
                                        }
                                    </style>
                                    <g transform="translate(0 1)">
                                        <g>
                                            <g>
                                                <path class="st0" d="M168.3,216.5c-31.1,0-55.8,24.7-55.8,55.8s24.7,55.8,55.8,55.8s55.8-24.7,55.8-55.8
                                                    C224.1,241.2,199.4,216.5,168.3,216.5z M168.3,312.2c-22.3,0-39.9-17.5-39.9-39.9c0-22.3,17.5-39.9,39.9-39.9
                                                    c21.5,0,39.9,17.5,39.9,39.9C208.2,294.6,190.7,312.2,168.3,312.2z" />
                                                                                    <path class="st0" d="M492.8,159.1c-2.4-4-8-6.4-12.8-6.4h-87.7c-4.8,0-8,3.2-8,8v23.9h-31.9v-23.9c0-4.8-3.2-8-8-8H169.1
                                                    c-0.1,0-0.1,0-0.2,0c-0.2,0-0.4,0-0.6,0c-52.2,0-96.4,33.2-112.8,79.7c-21.7,0.6-38.7,17.9-38.7,39.8c0,21.9,16.9,39.2,38.7,39.8
                                                    c16.4,46.5,60.6,79.7,112.8,79.7c52.5,0,97-33.6,113.1-80.6l166.7-31c5.6-0.8,10.4-4.8,12-10.4l34.3-96.5
                                                    C496.8,168.7,496,163.1,492.8,159.1z M32.8,272.3c0-11.1,7.9-20.6,18.2-23.1c-1.5,7.5-2.2,15.2-2.2,23.1c0,7.9,0.8,15.6,2.2,23.1
                                                    C40.7,292.9,32.8,283.4,32.8,272.3z M168.3,375.9c-50,0-91.5-35-101.4-82c-1.4-7.2-2.3-14.6-2.3-21.6c0-9.4,1.5-19.6,3.9-28.2
                                                    c12.2-43.6,52.2-75.4,99.8-75.4c57.4,0,103.6,46.2,103.6,103.6S225.7,375.9,168.3,375.9z M444.1,265.9l-158.5,29.5
                                                    c1.5-7.5,2.2-15.2,2.2-23.1c0-1.2,0-2.5-0.1-3.7c0-0.4,0-0.8,0-1.3c0-0.8-0.1-1.6-0.1-2.4c0-0.5-0.1-1-0.1-1.5
                                                    c0-0.6-0.1-1.3-0.2-1.9c-0.1-1.4-0.3-2.7-0.4-4.1c0-0.1,0-0.3-0.1-0.4c-4-31.7-20.2-59.2-43.9-78.1c-0.5-0.4-1-0.8-1.4-1.1
                                                    c-0.4-0.3-0.7-0.5-1.1-0.8c-0.8-0.6-1.6-1.2-2.5-1.8c-0.1-0.1-0.1-0.1-0.2-0.2c-1-0.7-2.1-1.4-3.1-2.1c0,0-0.1,0-0.1-0.1
                                                    c-1-0.7-2-1.3-3-2c-0.1-0.1-0.2-0.1-0.2-0.2c-1.1-0.7-2.1-1.3-3.2-1.9h107.6v23.9c0,4.8,3.2,8,8,8h47.8c4.8,0,8-3.2,8-8v-23.9
                                                    h79.7L444.1,265.9z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Dernek
                            </span>
                        </a>
                    </li>

                    <li class="nav-item @if(request()->routeIs('users.index')) active @endif">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ball-football" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 7l4.76 3.45l-1.76 5.55h-6l-1.76 -5.55z"></path>
                                    <path d="M12 7v-4m3 13l2.5 3m-.74 -8.55l3.74 -1.45m-11.44 7.05l-2.56 2.95m.74 -8.55l-3.74 -1.45"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Maçlar') }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                    <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                    <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Bilgi Bankası
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-flag-checkered me-2"></i>Hakemler
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user-tie me-2"></i>Gözlemciler
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-shield-halved me-2"></i>Takımlar
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-person-walking me-2"></i>Oyuncular
                            </a>
                        </div>
                    </li>

                    <li class="nav-item @if(request()->routeIs('about')) active @endif">
                        <a class="nav-link" href="{{ route('about') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                    <polyline points="3 7 12 13 21 7"></polyline>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('İletişim') }}
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>