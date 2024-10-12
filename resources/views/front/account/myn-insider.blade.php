@include('front.layouts.head')
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Myntra Insider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--<meta name="apple-mobile-web-app-status-bar-style" content="black"/>-->
    {{-- <style>
        /*! normalize.css v7.0.0 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block
        }

        h1 {
            font-size: 2em;
            margin: .67em 0
        }

        figcaption,
        figure,
        main {
            display: block
        }

        figure {
            margin: 1em 40px
        }

        hr {
            box-sizing: content-box;
            height: 0;
            overflow: visible
        }

        pre {
            font-family: monospace, monospace;
            font-size: 1em
        }

        a {
            background-color: transparent;
            -webkit-text-decoration-skip: objects
        }

        abbr[title] {
            border-bottom: none;
            text-decoration: underline;
            text-decoration: underline dotted
        }

        b,
        strong {
            font-weight: inherit
        }

        b,
        strong {
            font-weight: 700
        }

        code,
        kbd,
        samp {
            font-family: monospace, monospace;
            font-size: 1em
        }

        dfn {
            font-style: italic
        }

        mark {
            background-color: #ff0;
            color: #000
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        audio,
        video {
            display: inline-block
        }

        audio:not([controls]) {
            display: none;
            height: 0
        }

        img {
            border-style: none
        }

        svg:not(:root) {
            overflow: hidden
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: sans-serif;
            font-size: 100%;
            line-height: 1.15;
            margin: 0
        }

        button,
        input {
            overflow: visible
        }

        button,
        select {
            text-transform: none
        }

        [type=reset],
        [type=submit],
        button,
        html [type=button] {
            -webkit-appearance: button
        }

        [type=button]::-moz-focus-inner,
        [type=reset]::-moz-focus-inner,
        [type=submit]::-moz-focus-inner,
        button::-moz-focus-inner {
            border-style: none;
            padding: 0
        }

        [type=button]:-moz-focusring,
        [type=reset]:-moz-focusring,
        [type=submit]:-moz-focusring,
        button:-moz-focusring {
            outline: 1px dotted ButtonText
        }

        fieldset {
            padding: .35em .75em .625em
        }

        legend {
            box-sizing: border-box;
            color: inherit;
            display: table;
            max-width: 100%;
            padding: 0;
            white-space: normal
        }

        progress {
            display: inline-block;
            vertical-align: baseline
        }

        textarea {
            overflow: auto
        }

        [type=checkbox],
        [type=radio] {
            box-sizing: border-box;
            padding: 0
        }

        [type=number]::-webkit-inner-spin-button,
        [type=number]::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        [type=search]::-webkit-search-cancel-button,
        [type=search]::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        details,
        menu {
            display: block
        }

        summary {
            display: list-item
        }

        canvas {
            display: inline-block
        }

        template {
            display: none
        }

        [hidden] {
            display: none
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
            -webkit-text-size-adjust: none
        }

        :after,
        :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        :not(input):not(textarea):not(button) {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent
        }

        html {
            font-size: 10px;
            -webkit-tap-highlight-color: transparent
        }

        body {
            font-family: Assistant, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.42857143;
            color: #424553;
            background-color: #fff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
            outline: 0
        }

        a {
            color: #282c3f;
            text-decoration: none;
            outline: 0;
            -webkit-tap-highlight-color: transparent
        }

        a:focus,
        a:hover {
            color: #282c3f;
            text-decoration: none
        }

        a:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px
        }

        figure {
            margin: 0
        }

        img {
            vertical-align: middle
        }

        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto
        }

        [role=button] {
            cursor: pointer
        }

        .margin-lg {
            margin: 30px !important
        }

        .margin-lg-top {
            margin-top: 30px !important
        }

        .margin-lg-right {
            margin-right: 30px !important
        }

        .margin-lg-bottom {
            margin-bottom: 30px !important
        }

        .margin-lg-left {
            margin-left: 30px !important
        }

        .margin-md {
            margin: 18px !important
        }

        .margin-md-top {
            margin-top: 18px !important
        }

        .margin-md-right {
            margin-right: 18px !important
        }

        .margin-md-bottom {
            margin-bottom: 18px !important
        }

        .margin-dm-left {
            margin-left: 18px !important
        }

        .margin-sm {
            margin: 8px !important
        }

        .margin-sm-top {
            margin-top: 8px !important
        }

        .margin-sm-right {
            margin-right: 8px !important
        }

        .margin-sm-bottom {
            margin-bottom: 8px !important
        }

        .margin-sm-left {
            margin-left: 8px !important
        }

        .padding-lg {
            padding: 30px !important
        }

        .padding-lg-top {
            padding-top: 30px !important
        }

        .padding-lg-right {
            padding-right: 30px !important
        }

        .padding-lg-bottom {
            padding-bottom: 30px !important
        }

        .padding-lg-left {
            padding-left: 30px !important
        }

        .padding-md {
            padding: 18px !important
        }

        .padding-md-top {
            padding-top: 18px !important
        }

        .padding-md-right {
            padding-right: 18px !important
        }

        .padding-md-bottom {
            padding-bottom: 18px !important
        }

        .padding-md-left {
            padding-left: 18px !important
        }

        .padding-sm {
            padding: 8px !important
        }

        .padding-sm-top {
            padding-top: 8px !important
        }

        .padding-sm-right {
            padding-right: 8px !important
        }

        .padding-sm-bottom {
            padding-bottom: 8px !important
        }

        .padding-sm-left {
            padding-left: 8px !important
        }

        .badge {
            position: absolute;
            top: 9px;
            right: 4px;
            color: #fff;
            background: #ff3e6c;
            font-weight: 700;
            border-radius: 50%;
            font-size: 11px;
            display: inline-block;
            font-family: helvetica, arial, sans-serif;
            width: 19px;
            height: 19px;
            text-align: center;
            line-height: 19px
        }

        @font-face {
            font-family: Assistant;
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Regular.eot);
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Regular.eot?#iefix) format("embedded-opentype"), url(https://constant.myntassets.com/www/fonts/Assistant-Regular.woff) format("woff"), url(https://constant.myntassets.com/www/fonts/Assistant-Regular.ttf) format("truetype");
            font-weight: 400;
            font-style: normal;
            font-display: swap
        }

        @font-face {
            font-family: Assistant-Bold;
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Bold.eot);
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Bold.eot?#iefix) format("embedded-opentype"), url(https://constant.myntassets.com/www/fonts/Assistant-Bold.woff) format("woff"), url(https://constant.myntassets.com/www/fonts/Assistant-Bold.ttf) format("truetype");
            font-weight: 700;
            font-style: normal;
            font-display: swap
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit
        }

        .h1,
        .h2,
        .h3,
        h1,
        h2,
        h3 {
            margin-top: 0;
            margin-bottom: 9px
        }

        .h1 .small,
        .h1 small,
        .h2 .small,
        .h2 small,
        .h3 .small,
        .h3 small,
        h1 .small,
        h1 small,
        h2 .small,
        h2 small,
        h3 .small,
        h3 small {
            font-size: 65%
        }

        .h4,
        .h5,
        .h6,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 9px
        }

        .h4 .small,
        .h4 small,
        .h5 .small,
        .h5 small,
        .h6 .small,
        .h6 small,
        h4 .small,
        h4 small,
        h5 .small,
        h5 small,
        h6 .small,
        h6 small {
            font-size: 75%
        }

        .h1,
        h1 {
            font-size: 33px
        }

        .h2,
        h2 {
            font-size: 27px
        }

        .h3,
        h3 {
            font-size: 23px
        }

        .h4,
        h4 {
            font-size: 17px
        }

        .h5,
        h5 {
            font-size: 13px
        }

        .h6,
        h6 {
            font-size: 12px
        }

        p {
            margin: 0
        }

        .text-left {
            text-align: left
        }

        .text-right {
            text-align: right
        }

        .text-center {
            text-align: center
        }

        .text-justify {
            text-align: justify
        }

        .text-nowrap {
            white-space: nowrap
        }

        .text-lowercase {
            text-transform: lowercase
        }

        .text-uppercase {
            text-transform: uppercase
        }

        .text-capitalize {
            text-transform: capitalize
        }

        ol,
        ul {
            margin-top: 0;
            margin-bottom: 0
        }

        ol ol,
        ol ul,
        ul ol,
        ul ul {
            margin-bottom: 0
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none
        }

        .list-inline {
            padding-left: 0;
            list-style: none;
            margin-left: 0
        }

        .list-inline>li {
            display: inline-block;
            padding-left: 0;
            padding-right: 10px
        }

        .text-lg {
            font-size: 18px
        }

        .text-md {
            font-size: 14px
        }

        .text-sm {
            font-size: 12px
        }

        .text-ellipsis {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden
        }

        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 500;
            text-align: center;
            vertical-align: middle;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            outline: 0;
            padding: 10px 12px;
            font-size: 13px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none
        }

        .btn.focus,
        .btn:focus,
        .btn:hover {
            color: #3e4152;
            text-decoration: none
        }

        .btn[disabled] {
            opacity: .5
        }

        .btn.default {
            color: #3e4152;
            background-color: #fff;
            border-color: #ccc
        }

        .btn.default.flat,
        .btn.default.outline {
            color: #3e4152
        }

        .btn.primary {
            color: #fff;
            background-color: #ff3e6c;
            border-color: #ff2459
        }

        .btn.primary.flat,
        .btn.primary.outline {
            color: #ff3e6c
        }

        .btn.secondary {
            color: #fff;
            background-color: #3d82f7;
            border-color: #2572f6
        }

        .btn.secondary.flat,
        .btn.secondary.outline {
            color: #3d82f7
        }

        .btn.flat {
            border-color: transparent;
            background-color: #fff
        }

        .btn.outline {
            border-color: #ccc;
            background-color: #fff
        }

        .btn.lg {
            padding: 10px 16px;
            font-size: 13px;
            line-height: 1.3333333;
            border-radius: 6px
        }

        .btn.md {
            padding: 5px 10px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 3px
        }

        .btn.sm {
            padding: 4px 6px;
            font-size: 11px;
            line-height: 1.5;
            border-radius: 3px
        }

        .btn.block {
            display: block;
            width: 100%
        }

        .btn.block+.btn.block {
            margin-top: 5px
        }

        .btn input[type=button].block,
        .btn input[type=reset].block,
        .btn input[type=submit].block {
            width: 100%
        }

        .btn [class*=" icon-"],
        .btn [class^=icon-] {
            font-size: 16px;
            margin-right: 14px;
            vertical-align: text-bottom
        }

        fieldset {
            padding: 0;
            margin: 0;
            border: 0;
            min-width: 0
        }

        input[type=search] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        input[type=checkbox],
        input[type=radio] {
            margin: 4px 0 0;
            line-height: normal
        }

        input[type=file] {
            display: block
        }

        select[multiple],
        select[size] {
            height: auto
        }

        input[type=checkbox]:focus,
        input[type=file]:focus,
        input[type=radio]:focus {
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px
        }

        input {
            caret-color: #ff2459
        }

        .form-control {
            display: block;
            width: 100%;
            height: 40px;
            padding: 10px 0;
            font-size: 13px;
            line-height: 1.42857143;
            color: #3e4152;
            background-color: #fff;
            background-image: none;
            border: none
        }

        .form-control:focus {
            outline: 0
        }

        .form-control::-moz-placeholder {
            color: #9fa0a9;
            opacity: 1
        }

        .form-control:-ms-input-placeholder {
            color: #9fa0a9
        }

        .form-control::-webkit-input-placeholder {
            color: #9fa0a9
        }

        .form-control::-ms-expand {
            border: 0;
            background-color: transparent
        }

        .form-control[disabled],
        fieldset[disabled] .form-control {
            cursor: not-allowed
        }

        textarea.form-control {
            height: auto
        }

        .form-control.has-feedback {
            padding-right: 60px
        }

        input[type=search] {
            -webkit-appearance: none
        }

        @media screen and (-webkit-min-device-pixel-ratio:0) {

            input[type=date].form-control,
            input[type=datetime-local].form-control,
            input[type=month].form-control,
            input[type=time].form-control {
                line-height: 40px
            }
        }

        .form-group {
            margin-bottom: 14px;
            position: relative
        }

        .form-group .form-control-feedback {
            position: absolute;
            top: 4px;
            right: 0;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            font-size: 11px;
            line-height: 34px;
            text-align: center;
            color: #ff3e6c;
            font-weight: 700
        }

        .form-group .bar {
            position: relative;
            border-bottom: 1px solid #a9abb3;
            display: block
        }

        .form-group .bar::before {
            content: '';
            height: 1px;
            width: 0;
            left: 50%;
            bottom: -1px;
            position: absolute;
            transition: left .3s ease, width .3s ease;
            z-index: 2
        }

        .form-group input:focus~.bar::before {
            width: 100%;
            left: 0
        }

        .form-group input:focus~.bar::before {
            background: #0f0
        }

        .form-group input:focus[readonly]~.bar::before {
            background: 0 0
        }

        .form-group .errorContainer {
            font-size: 11px;
            color: #ff5a5a;
            margin-top: 10px
        }

        .grid {
            background: #fff;
            margin: 0 0 16px 0
        }

        .grid:after {
            content: "";
            display: table;
            clear: both
        }

        [class*=col-] {
            float: left;
            padding-right: 16px
        }

        .grid [class*=col-]:last-of-type {
            padding-right: 0
        }

        .col-2-3 {
            width: 66.66%
        }

        .col-1-3 {
            width: 33.33%
        }

        .col-1-2 {
            width: 50%
        }

        .col-1-4 {
            width: 25%
        }

        .col-1-8 {
            width: 12.5%
        }

        .grid-pad {
            padding: 16px 0 16px 16px
        }

        .grid-pad [class*=col-]:last-of-type {
            padding-right: 16px
        }

        .animated {
            animation-duration: 1s;
            animation-fill-mode: both
        }

        .animated.infinite {
            animation-iteration-count: infinite
        }

        .fade-in-show {
            opacity: 0;
            animation: opacity .5s cubic-bezier(.4, 0, .2, 1) 0s forwards
        }

        @keyframes opacity {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes pulse {
            0% {
                transform: scaleX(1)
            }

            50% {
                transform: scale3d(1.1, 1.1, 1.1)
            }

            to {
                transform: scaleX(1)
            }
        }

        .pulse {
            animation-name: pulse
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0)
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0)
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0)
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0)
            }
        }

        .shake {
            animation-name: shake
        }

        @keyframes bounceIn {

            0%,
            30%,
            60%,
            80%,
            to {
                animation-timing-function: cubic-bezier(.215, .61, .355, 1)
            }

            0% {
                opacity: 0;
                transform: scale3d(.8, .8, .8)
            }

            30% {
                transform: scale3d(1.03, 1.03, 1.03)
            }

            60% {
                opacity: 1;
                transform: scale3d(.8, .8, .8)
            }

            80% {
                transform: scale3d(1, 1, 1)
            }

            to {
                opacity: 1;
                transform: scaleX(1)
            }
        }

        .bounceIn {
            animation-name: bounceIn
        }

        .skeleton-loader {
            height: 100%;
            background: #f6f7f8;
            background-image: linear-gradient(to right, #f6f7f8 0, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-repeat: no-repeat;
            background-size: 800px 100%;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: loading-skeleton;
            animation-timing-function: linear
        }

        @keyframes loading-skeleton {
            0% {
                background-position: -468px 0
            }

            100% {
                background-position: 468px 0
            }
        }

        .btn-group {
            position: relative;
            display: inline-block;
            vertical-align: middle
        }

        .btn-group>.btn {
            position: relative;
            float: left
        }

        .btn-group>.btn.active,
        .btn-group>.btn:active,
        .btn-group>.btn:focus,
        .btn-group>.btn:hover {
            z-index: 2
        }

        .btn-group .btn+.btn,
        .btn-group .btn+.btn-group,
        .btn-group .btn-group+.btn,
        .btn-group .btn-group+.btn-group {
            margin-left: -1px
        }

        .btn-group>.btn-group:not(:first-child) .btn {
            border-left: none
        }

        .btn-group>.btn:not(:first-child):not(:last-child) {
            border-radius: 0
        }

        .btn-group>.btn:first-child {
            margin-left: 0
        }

        .btn-group>.btn:first-child:not(:last-child) {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0
        }

        .btn-group>.btn:last-child:not(:first-child) {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0
        }

        .btn-group>.btn-group {
            float: left
        }

        .btn-group>.btn-group:not(:first-child):not(:last-child)>.btn {
            border-radius: 0
        }

        .btn-group>.btn-group:first-child:not(:last-child)>.btn:last-child {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0
        }

        .btn-group>.btn-group:last-child:not(:first-child)>.btn:first-child {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0
        }

        .btn-group-justified {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: separate
        }

        .btn-group-justified>.btn,
        .btn-group-justified>.btn-group {
            float: none;
            display: table-cell;
            width: 1%
        }

        .btn-group-justified>.btn-group .btn {
            width: 100%
        }

        .notifyMainContainer {
            position: fixed;
            width: 85%;
            margin: 0 auto;
            left: 0;
            right: 0;
            min-height: 50px;
            z-index: 20000;
            opacity: 0;
            display: block;
            text-align: center;
            transform-origin: center bottom;
            border-radius: 4px;
            animation: popNotification 150ms cubic-bezier(.4, 0, .2, 1) 0s;
            animation: opacity 225ms cubic-bezier(.4, 0, .2, 1) 0s;
            font-size: 14px
        }

        .notifyContent {
            position: relative;
            font-size: 12px;
            border-radius: 4px;
            display: inline-block;
            animation: boxShadow .3s cubic-bezier(.4, 0, .2, 1) 0s
        }

        .notifyerror {
            color: #fff;
            background-color: #ff5a5a
        }

        .notifyinfo {
            color: #fff;
            background-color: #535766
        }

        .notifytop {
            top: 65px
        }

        .notifybottom {
            bottom: 0
        }

        .notifyActionerror {
            color: #ff3f6c;
            background-color: #fff;
            border: 1px solid #ff3f6c
        }

        .notifyActioninfo {
            color: #fff;
            background-color: #14cda8;
            border: 1px solid #14cda8
        }

        .notifyShow {
            opacity: 1
        }

        .hidey {
            display: none
        }

        .notifyActionDiv,
        .notifyText,
        .notifyThumbnail {
            display: inline-block;
            max-height: 50px;
            vertical-align: middle
        }

        .notifyThumbnail img {
            padding: 5px;
            height: 40px;
            min-width: 30px
        }

        .notifyActionDiv {
            float: right;
            margin-top: 10px
        }

        .notifyText {
            font-weight: 700;
            font-size: 13px;
            padding: 8px 16px;
            max-height: initial
        }

        .notifyAction {
            border-radius: 3px;
            outline: 0;
            padding: 3px 4px;
            min-height: 30px;
            font-size: 12px;
            font-weight: 700;
            margin: 0 5px 0 5px;
            float: right;
            width: 73px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        @keyframes popNotification {
            0% {
                transform: scale(.8);
                opacity: 0
            }

            100%,
            3.75% {
                transform: scale(1);
                opacity: 1
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes boxShadow {
            0% {
                box-shadow: none
            }

            100% {
                box-shadow: 0 3px 5px -1px rgba(0, 0, 0, .2), 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12)
            }
        }

        .nav {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none
        }

        .nav--visible {
            pointer-events: auto;
            z-index: 150
        }

        .app-nav {
            background-color: #fff;
            color: #333;
            position: relative;
            max-width: 400px;
            width: 90%;
            height: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .5);
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
            display: flex;
            flex-direction: column;
            will-change: transform;
            z-index: 120;
            pointer-events: auto
        }

        .nav--visible .app-nav {
            -webkit-transform: none;
            transform: none
        }

        .nav--animatable .app-nav {
            transition: transform 225ms cubic-bezier(0, 0, .2, 1) 0s
        }

        .nav:after {
            content: '';
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .4);
            opacity: 0;
            will-change: opacity;
            pointer-events: none;
            transition: opacity 225ms cubic-bezier(.4, 0, .2, 1) 0s
        }

        .nav--visible.nav:after {
            opacity: 1;
            pointer-events: auto
        }

        .layout {
            position: relative
        }

        .site-nav-container {
            background-color: #fff;
            position: fixed;
            z-index: 100;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgba(148, 150, 159, .3)
        }

        .site-nav-container.dark-mode {
            box-shadow: none;
            background: #000
        }

        .site-nav-container.dark-mode path {
            fill: #fff
        }

        .site-nav-container a {
            -webkit-tap-highlight-color: rgba(0, 0, 0, .1);
            display: inline-block
        }

        .site-nav-container .icon {
            width: 48px;
            height: 48px
        }

        .site-nav-container .header-icon {
            width: 24px;
            height: 24px;
            margin: 16px 16px 16px 0;
            display: inline-block
        }

        .site-nav-container #header-search-a2hs {
            position: relative;
            top: 1px;
            vertical-align: top;
            display: none;
            height: 22px;
            margin: 17px 16px 16px 0
        }

        .site-nav-container .menu-icon {
            margin-left: 16px !important;
            display: inline-block;
            vertical-align: top
        }

        .icon-a2hs {
            padding-bottom: 12px
        }

        @media only screen and (max-width:370px) {
            .header-title {
                width: 32%
            }
        }

        @media only screen and (min-width:370px) {
            .header-title {
                width: 40%
            }
        }

        .header-title {
            font-size: 16px;
            vertical-align: top;
            top: 19px;
            position: relative;
            font-family: Assistant-Bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: normal;
            text-transform: capitalize
        }

        .header-heading {
            font-weight: 700
        }

        .header-sub-heading {
            font-size: 12px;
            font-weight: 400
        }

        .header-actions {
            display: inline-block
        }

        .header-actions a {
            display: inline-block
        }

        .header-actions .icon {
            position: relative
        }

        .nav-icon {
            display: inline-block
        }

        .app-nav {
            width: 75%;
            box-shadow: none;
            background-color: #fff
        }

        .logo {
            display: inline-block;
            vertical-align: top;
            padding-top: 9px;
            padding-left: 15px;
            font-size: 0;
            margin-left: -6px;
            width: 32px;
            height: 32px
        }

        .logo a {
            display: inline-block
        }

        #mainContent {
            padding-top: 56px
        }

        .clicked-anim {
            width: 206px;
            top: 0;
            transform: scale(2, 2);
            -webkit-transform: scale(2, 2);
            -moz-transform: scale(2, 2);
            -o-transform: scale(2, 2);
            -ms-transform: scale(2, 2);
            transform-origin: 0 0;
            z-index: 9
        }

        .clicked {
            position: fixed;
            z-index: 9
        }

        .bigImageDefault {
            transition: all .5s cubic-bezier(.4, 0, .2, 1);
            border: 1px solid #fff
        }

        .homeSwipe-enter {
            opacity: .01
        }

        .homeSwipe-enter.homeSwipe-enter-active {
            opacity: 1;
            transition: all .5s ease-in
        }

        .homeSwipe-leave {
            opacity: 1
        }

        .homeSwipe-leave.homeSwipe-leave-active {
            opacity: .01;
            transition: all 10s ease-in
        }

        ul.nav-ul {
            list-style: none;
            padding: 10px
        }

        li.nav-link {
            padding: 10px;
            font-weight: 400
        }

        li.nav-link a {
            text-decoration: none
        }

        .linkClean {
            text-decoration: none
        }

        .icon {
            padding: 15px;
            display: inline-block;
            font-size: 16px
        }

        .logo-inline {
            width: 32px;
            height: 32px;
            display: inline-block;
            background-position: center;
            background-size: contain
        }

        .desktop-header-container {
            color: #fff;
            top: 0;
            margin-bottom: 20px;
            right: 0;
            left: 0;
            z-index: 9;
            box-shadow: 0 4px 12px 0 rgba(0, 0, 0, .05);
            background-color: #fff;
            height: 80px;
            position: fixed
        }

        .desktop-logo-container {
            float: left;
            height: inherit;
            margin-left: 4%
        }

        .myntraweb-sprite {
            background: url(https://constant.myntassets.com/web/assets/img/MyntraWebSprite_27_01_2021.png);
            background-size: 1404px 105px;
            display: inline-block
        }

        .desktop-logo {
            display: inline-block;
            vertical-align: middle;
            padding: 0;
            width: 53px;
            height: 36px;
            background-position: -462px 0;
            margin: 22px 0;
            cursor: pointer
        }

        .desktop-actions {
            float: right;
            display: flex;
            line-height: 0;
            height: 40px;
            margin: 20px 30px 0 30px
        }

        .desktop-cart,
        .desktop-wishlist {
            display: flex;
            text-decoration: none;
            position: relative
        }

        .desktop-cart {
            margin: 0 50px 0 15px
        }

        .desktop-wishlist {
            margin: 0 55px 0 10px
        }

        .desktop-iconWishlist {
            left: 15px
        }

        .desktop-iconBag,
        .desktop-iconWishlist {
            margin: 8px 0 0;
            position: absolute;
            bottom: 14px
        }

        .desktop-iconBag {
            left: -1px
        }

        .sprites-headerWishlist {
            width: 17px;
            height: 22px;
            background-position: -315px -81px
        }

        .sprites-headerBag {
            width: 22px;
            height: 22px;
            background-position: -341px -56px
        }

        .desktop-userTitle {
            color: #000;
            position: absolute;
            bottom: 4px;
            left: 1px;
            font-size: 11px;
            font-weight: 700;
            display: inline-block;
            padding-top: 10px;
            line-height: 6px
        }

        .desktop-navlink-container {
            display: block;
            float: left;
            line-height: 80px;
            height: 80px;
            margin: 0 0 0 3.5%
        }

        .desktop-navcontent {
            font-size: 14px;
            padding: 0 17px;
            color: #282c3f;
            font-weight: 700;
            display: inline-block;
            cursor: pointer
        }

        .desktop-input-container {
            float: right;
            width: 465px;
            line-height: 0;
            margin: 20px 20px 20px 60px;
            position: relative
        }

        .desktop-input {
            box-sizing: content-box;
            padding: 8px 10px 10px 10px;
            margin: 0;
            outline: 0;
            float: left;
            border: 1px solid #f5f5f6;
            border-radius: 4px;
            color: #696e79;
            width: 95%;
            padding: 12px;
            background-color: #f5f5f6
        }

        .desktop-submit {
            box-sizing: content-box;
            display: inline-block;
            height: 28px;
            width: 40px;
            text-align: center;
            padding: 8px 0 2px 0;
            background: #f5f5f6;
            border: 1px solid #f5f5f6;
            border-right: none;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
            position: absolute;
            left: -41px;
            cursor: pointer
        }

        .desktop-iconSearch {
            width: 21px;
            height: 21px;
            background-position: -754px 0;
            display: inline-block;
            transform: scale(.7)
        }

        @media (max-width:1250px) {
            .desktop-input-container {
                width: 240px
            }

            .desktop-navcontent {
                padding: 0 14px
            }

            .desktop-actions {
                margin: 20px 30px 0 10px
            }
        }

        @media screen and (min-width:1250px) and (max-width:1400px) {
            .desktop-input-container {
                width: 360px
            }

            .desktop-actions {
                margin: 20px 30px 0 20px
            }
        }

        .LazyLoad {
            width: auto !important
        }

        .LazyLoad img {
            background: #fff;
            color: #fff
        }

        .rnw-brightcove-video {
            width: 100%;
            height: 100%
        }

        .rnw-brightcove-video .wrapper {
            height: inherit;
            z-index: 3
        }

        .rnw-brightcove-video .video-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: -3
        }

        .rnw-brightcove-video .vjs-dock-text {
            display: none !important
        }

        .rnw-brightcove-video .vjs-progress-control {
            display: none !important
        }

        .rnw-brightcove-video .vjs-control-bar {
            display: none !important
        }

        .rnw-brightcove-video .vjs-big-play-button {
            display: none !important
        }

        .matrix-player {
            background: #000;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .matrix-player .video-js {
            width: 100%;
            height: 100%;
            background: #000;
            display: flex
        }

        .matrix-player .video-js .vjs-tech {
            width: 100%
        }

        .matrix-player .video-js .vjs-big-play-button,
        .matrix-player .video-js .vjs-control-bar,
        .matrix-player .video-js .vjs-control-text,
        .matrix-player .video-js .vjs-dock-text,
        .matrix-player .video-js .vjs-error-display,
        .matrix-player .video-js .vjs-errors-dialog,
        .matrix-player .video-js .vjs-loading-spinner,
        .matrix-player .video-js .vjs-menu.vjs-contextmenu-ui-menu,
        .matrix-player .video-js .vjs-modal-dialog {
            display: none !important
        }

        .matrix-player .mute-toggle {
            position: absolute;
            bottom: 16px;
            left: 16px;
            width: 16px
        }

        .matrix-player .remaining-time {
            display: inline-block;
            position: absolute;
            color: #fff;
            top: 16px;
            right: 16px;
            font-size: 14px
        }

        .clearfix:after,
        .clearfix:before {
            content: " ";
            display: table
        }

        .clearfix:after {
            clear: both
        }

        .pull-right {
            float: right !important
        }

        .pull-left {
            float: left !important
        }

        .hide {
            display: none !important
        }

        .show {
            display: block !important
        }

        .invisible {
            visibility: hidden
        }

        .hidden {
            display: none !important
        }

        .affix {
            position: fixed
        }

        .no-scroll-background {
            overflow: hidden
        }

        .loader-animation-container {
            position: fixed;
            top: 50px;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 115
        }

        .loader-animation-container .spinner-container {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            margin-top: -25px;
            margin-left: -25px;
            z-index: 6;
            text-align: center
        }

        .mynt-spinner {
            animation: 2s linear infinite mynt-svg-animation;
            width: 40px;
            height: 40px;
            padding: 5px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e0e0e0;
            will-change: transform
        }

        @keyframes mynt-svg-animation {
            0% {
                transform: rotateZ(0)
            }

            100% {
                transform: rotateZ(360deg)
            }
        }

        .circle,
        .mynt-spinner circle {
            animation: 1.4s ease-in-out infinite both mynt-circle-animation;
            display: block;
            fill: transparent;
            stroke: #ff3e6c;
            stroke-linecap: round;
            stroke-dasharray: 283;
            stroke-dashoffset: 280;
            stroke-width: 8px;
            transform-origin: 50% 50%;
            will-change: transform
        }

        @keyframes mynt-circle-animation {

            0%,
            25% {
                stroke-dashoffset: 280;
                transform: rotate(0)
            }

            50%,
            75% {
                stroke-dashoffset: 75;
                transform: rotate(45deg)
            }

            100% {
                stroke-dashoffset: 280;
                transform: rotate(360deg)
            }
        }

        .mainHeader {
            background: #fff;
            height: 78px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
            position: fixed;
            padding: 20px 0 0;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 9999
        }

        .headerContent {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
            padding: 0 20px;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .headerContent img {
            width: auto;
            height: 40px
        }

        .style-nav--list li {
            margin: 0 15px
        }

        .myntra-logo,
        .style-nav--list,
        .style-nav--list li {
            display: inline-block
        }

        .style-nav--list {
            font-size: 16px;
            font-size: 15px;
            color: #282c3f;
            font-weight: 400;
            padding: 0 30px;
            position: relative;
            top: 4px
        }

        .style-nav--list li a:hover {
            color: #282c3f
        }

        .error-component-wrapper {
            position: relative;
            font-size: 14px;
            line-height: 1.43;
            color: #0e0f17;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 100vh
        }

        .error-component-wrapper .error-component-icon {
            width: 146px;
            height: 182px;
            object-fit: contain;
            margin-bottom: 48px
        }

        .error-component-wrapper .error-component-header {
            font-family: Assistant-Bold;
            margin-bottom: 6px
        }

        .error-component-wrapper .error-component-content {
            width: 209px;
            text-align: center;
            margin-bottom: 24px
        }

        .error-component-wrapper .error-component-button {
            width: 169px;
            height: 40px;
            font-family: Assistant-Bold;
            text-align: center;
            color: #282c3f;
            padding: 10px 16px;
            border-radius: 2px;
            border: 1px solid #d4d5d8;
            margin-bottom: 80px
        }

        .error-component-wrapper .error-component-footer {
            font-family: Assistant-Bold;
            color: #686b77;
            position: absolute;
            bottom: 75px
        }

        .widget-error {
            height: 100%;
            padding: 8px 0
        }

        .widget-error .error-component-button {
            margin-bottom: 0
        }

        @font-face {
            font-family: Assistant;
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Regular.eot);
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Regular.eot#iefix) format("embedded-opentype"), url(https://constant.myntassets.com/www/fonts/Assistant-Regular.woff) format("woff"), url(https://constant.myntassets.com/www/fonts/Assistant-Regular.ttf) format("truetype");
            font-weight: 400;
            font-style: normal;
            font-display: swap
        }

        @font-face {
            font-family: Assistant-Bold;
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Bold.eot);
            src: url(https://constant.myntassets.com/www/fonts/Assistant-Bold.eot#iefix) format("embedded-opentype"), url(https://constant.myntassets.com/www/fonts/Assistant-Bold.woff) format("woff"), url(https://constant.myntassets.com/www/fonts/Assistant-Bold.ttf) format("truetype");
            font-weight: 700;
            font-style: normal;
            font-display: swap
        }

        * {
            font-family: Assistant
        }

        strong {
            font-weight: 900 !important
        }

        body {
            background: #fff
        }

        body.bg-desktop {
            background: #ffd6f2;
            background: linear-gradient(to bottom right, #ffd6f2, #dbd5ff);
            background-repeat: no-repeat
        }

        #reactPageContent {
            min-height: 100vh;
            position: relative;
            background: #fff;
            --color-watermelon: #ff3f6c;
            --color-blueberry: #282c3f
        }

        #reactPageContent.header-tb-margin {
            position: relative;
            margin-top: 120px;
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, .2);
            margin-bottom: 50px
        }

        #reactPageContent.header-tb-margin--min {
            position: relative;
            margin-top: 78px;
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, .2)
        }

        .header-tb-margin--min .back-wrapper {
            top: 78px
        }

        .header-in-app .back-wrapper {
            visibility: hidden;
            height: 0;
            padding: 0
        }

        .header-in-app .back-wrapper.popup-scrolled .header-text {
            visibility: hidden !important;
            height: 0;
            padding: 0
        }

        .header-m--web .back-wrapper {
            visibility: visible;
            top: 50px
        }

        #mainContent {
            min-height: 100vh
        }

        .no-scroll-background-body {
            overflow: hidden !important
        }

        .text-link {
            color: var(--color-watermelon) !important;
            font-family: Assistant-Bold;
            line-height: normal
        }

        @media screen and (min-width:421px) {
            #reactPageContent {
                max-width: 380px;
                margin: 0 auto
            }
        }

        #reactPageContent.mobile-width--full {
            max-width: 100% !important;
            margin: 0 auto
        }

        .navi .naviWrapper {
            font-size: 15px;
            text-decoration: none;
            color: #3e4152;
            display: block
        }

        .navi .naviWrapper .naviWrapper {
            padding-left: 20px
        }

        .navi .naviLevel {
            display: block;
            padding: 16px 24px;
            border-bottom: 1px solid #eaeaec;
            font-size: 13px
        }

        .navi .naviLevel.title {
            font-size: 10px;
            color: #94969f;
            border-bottom: 0;
            padding-bottom: 0
        }

        .navi .naviLevel.level-1 {
            font-weight: 500
        }

        .navi .naviLevel.level-2,
        .navi .naviLevel.level-3 {
            font-weight: 400
        }

        .ripple-container {
            position: relative;
            overflow: hidden
        }

        .ripple-container .ripple {
            position: absolute;
            top: 0;
            left: 0
        }

        .ripple-container .ripple .span {
            transform: scale(0);
            border-radius: 100%;
            position: absolute;
            opacity: .75;
            background-color: #e53860;
            animation: a .5s
        }

        @keyframes a {
            0% {
                opacity: .75;
                transform: scale(0)
            }

            to {
                opacity: 0;
                transform: scale(2)
            }
        }

        .sidebar-container .menu-ctn {
            min-height: calc(100vh - 40px)
        }

        .sidebar-container .nav-ul {
            background: #fff
        }

        .sidebar-container .user-specific-links {
            background: #f5f5f6
        }

        .sidebar-container .user-specific-links .naviLevel {
            border: 0
        }

        .sidebar-container .contact-us {
            background: #f5f5f6;
            height: 40px
        }

        .sidebar-container .contact-us .naviWrapper {
            font-size: 9px;
            font-weight: 400
        }

        .sidebar-container .contact-us .naviWrapper .naviLevel {
            border: 0
        }

        .app-nav {
            position: relative;
            height: 100%;
            background: #f5f5f6;
            overflow-y: scroll
        }
    </style> --}}
   
</head>

<body style="min-height:100%" cz-shortcut-listen="true" class="bg-desktop">

    <div id="mainContent" class="container-fluid vh-100 d-flex flex-column p-0">
        <div id="mainReactContent" class="flex-grow-1 d-flex justify-content-center align-items-center">
            <div class="card w-100 mx-auto" style="max-width: 800px;">
                <div class="card-header bg-light">
                    <div class="text-center mb-4">
                        <a href="#" target="_blank">
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/1/27/fbf63764-46e8-4aa1-9fdf-5d19983646e51611739436303-486f4a63-d088-4e38-8b64-e7119d6a8f2f1591176340487-myntra-new-app-icon-3x.png" class="img-fluid" alt="Myntra logo">
                        </a>
                    </div>
                    <h4 class="text-center">Hi Usman,</h4>
                    <p class="text-center">We’re pleased to see your interest in the Insider program.</p>
                    <p class="text-center">You’re just a few purchases away from your goal!</p>
                </div>
    
                <div class="card-body overflow-auto">
                    <!-- Goals Section -->
                    <h5>How To Get There</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/6/10/af3827a0-d814-4adf-9c64-875056c24b571623268092599-Slice-8-3x--1---1-.png" class="img-fluid" alt="Goal image">
                            <p>₹0 Spent</p>
                            <p>Goal: ₹4000</p>
                        </div>
                        <div>
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/6/10/af3827a0-d814-4adf-9c64-875056c24b571623268092599-Slice-8-3x--1---1-.png" class="img-fluid" alt="Order Goal">
                            <p>0/2 Orders</p>
                            <p>Goal: 2 Orders</p>
                        </div>
                    </div>
    
                    <p class="text-center my-4">
                        You need to <strong>shop for ₹4000 more</strong> and place <strong>2 more orders</strong> to reach your goals.
                    </p>
    
                    <!-- Benefits Section -->
                    <h5>Benefits Of Joining The Program</h5>
                    <div class="row text-center">
                        <div class="col-4">
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/5/27/3e765afa-de7c-44dd-9379-5c12e7a5c6971622109794253-Early-access-to-sale-3x--1-.png" class="img-fluid" alt="Benefit">
                            <p>Early Access to Sales</p>
                        </div>
                        <div class="col-4">
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/5/27/8cb20882-94ba-464f-9d76-0a4004a52fbe1622110065196-Slice-26-3x.png" class="img-fluid" alt="Exclusive Rewards">
                            <p>Insider Exclusive Rewards & Benefits</p>
                        </div>
                        <div class="col-4">
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2021/9/2/6e1c32ff-1026-45ff-b86b-7c11c9ccd3211630587839913-Free-shipping-2x.png" class="img-fluid" alt="Free Shipping">
                            <p>Free Shipping</p>
                        </div>
                    </div>
    
                    <!-- Rewards Section -->
                    <h5 class="mt-4">Rewards</h5>
                    <div class="row text-center">
                        <div class="col-6">
                            <img src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/74e9ae39-2302-42e7-ad8c-917e51b2206c1630656211389-Get-Myntra-Voucher-worth-Rs.500.jpg" class="img-fluid" alt="Reward">
                            <p>Get Myntra Voucher worth Rs.500</p>
                        </div>
                        <div class="col-6">
                            <img src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/4ef867c9-1129-4e3c-98c8-b67711845e421630656211382-Get-Leivs-Voucher-worth-Rs.-500.jpg" class="img-fluid" alt="Reward">
                            <p>Get Levi's Voucher worth Rs.500</p>
                        </div>
                    </div>
                </div>
    
                <!-- Sticky Button -->
                <div class="card-footer bg-light text-center sticky-bottom">
                    <button class="btn btn-primary w-100">CONTINUE SHOPPING</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="header">
        <div class="site-nav-container" style="display: none;">
            <div id="header-menu-icon" class="header-icon menu-icon"><svg viewBox="0 0 24 24">
                    <path
                        d="M3.444 5.422a.733.733 0 110-1.466h17.047a.733.733 0 110 1.466H3.444zm0 7.111a.733.733 0 110-1.466h17.047a.733.733 0 110 1.466H3.444zm0 7.111a.733.733 0 110-1.466h17.047a.733.733 0 110 1.466H3.444z"
                        fill="#3E4152" fillrule="evenodd"></path>
                </svg></div>
            <div id="header-back-icon" class="hide nav-icon"><a href="/back"><svg
                        class="header-icon menu-icon" viewBox="0 0 24 24">
                        <path fill="#3E4152" fillrule="evenodd"
                            d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5">
                        </path>
                    </svg></a></div>
            <div class="nav-icon header-title" style="top:19px">Myntra</div>
            <div class="header-actions pull-right"><a id="header-search-icon" class="header-icon"
                    href="/autosuggest"><svg viewBox="0 0 24 24">
                        <path fill="#3E4152" fillrule="evenodd"
                            d="M3.438 9.754a6.415 6.415 0 016.408-6.409 6.415 6.415 0 016.409 6.409 6.416 6.416 0 01-6.409 6.408 6.416 6.416 0 01-6.408-6.408M21.816 20.87l-5.974-6.02a7.839 7.839 0 001.88-5.097c0-4.343-3.534-7.875-7.876-7.875-4.342 0-7.875 3.532-7.875 7.875 0 4.342 3.533 7.875 7.875 7.875a7.837 7.837 0 004.946-1.753l5.983 6.029a.73.73 0 001.037.004.733.733 0 00.004-1.038">
                        </path>
                    </svg></a>
                <div id="header-wishlist-icon" onclick="wishlistIconClick()" style="display:inline-block"
                    class="header-icon"><svg viewBox="0 0 24 24">
                        <g stroke="none" strokewidth="1" fill="none" fillrule="evenodd">
                            <g fill="#3E4152">
                                <path
                                    d="M8.1703,4.473425 C6.9537,4.473425 5.8134,4.946625 4.95975,5.805525 C4.10435,6.666175 3.63325,7.815575 3.63325,9.042675 C3.63325,10.269775 4.10435,11.419525 4.95975,12.280175 L12,19.362425 L19.0406,12.279825 C19.89565,11.419525 20.36675,10.270125 20.36675,9.042675 C20.36675,7.815575 19.89565,6.665825 19.0406,5.805875 C19.0406,5.805875 19.0406,5.805525 19.04025,5.805525 C18.1866,4.946625 17.0463,4.473425 15.8297,4.473425 C14.6138,4.473425 13.4742,4.946275 12.62055,5.804475 C12.29225,6.134525 11.70845,6.134875 11.3798,5.804475 C10.5258,4.946275 9.3862,4.473425 8.1703,4.473425 L8.1703,4.473425 Z M12.02835,21.276575 L11.972,21.276575 C11.6304,21.276575 11.2965,21.137625 11.05605,20.895075 L3.71865,13.513925 C2.53495,12.323225 1.88325,10.735275 1.88325,9.042675 C1.88325,7.350075 2.53495,5.762475 3.71865,4.571775 C4.9034,3.379675 6.48435,2.723425 8.1703,2.723425 C9.5759,2.723425 10.90905,3.179825 12,4.022625 C13.0913,3.179825 14.4241,2.723425 15.8297,2.723425 C17.516,2.723425 19.09695,3.379675 20.2817,4.572125 C21.46505,5.762475 22.11675,7.350075 22.11675,9.042675 C22.11675,10.735625 21.46505,12.323225 20.2817,13.513925 L12.94325,20.895775 C12.6993,21.141475 12.3745,21.276575 12.02835,21.276575 L12.02835,21.276575 Z">
                                </path>
                            </g>
                        </g>
                    </svg></div><a id="header-cart-icon" class="header-icon" href="/checkout/cart"><svg
                        viewBox="0 0 24 24">
                        <path fill="#3E4152" fillrule="evenodd"
                            d="M4.012 20.718L5.246 7.314H7.27v1.763a.733.733 0 101.466 0V7.314h6.528v1.763a.733.733 0 001.466 0V7.314h2.024l1.234 13.404H4.012zM12 3.282c1.56 0 2.865 1.1 3.187 2.565H8.813A3.268 3.268 0 0112 3.282zm8.15 3.228a.733.733 0 00-.73-.663h-2.747A4.734 4.734 0 0012 1.816a4.734 4.734 0 00-4.673 4.03H4.58a.733.733 0 00-.73.664L2.475 21.38a.734.734 0 00.73.804h17.59a.733.733 0 00.73-.803L20.15 6.51z">
                        </path>
                    </svg></a>
            </div>
        </div>
    </div>
    <div id="mainContent" style="padding-top: 0px;">
        <div id="mainReactContent">
            <div class="mainHeader" style="z-index: 9999;">
                <div class="headerContent"><a href="" target="_blank" class="myntra-logo"><img
                            src="https://assets.myntassets.com/assets/images/retaillabs/2021/1/27/fbf63764-46e8-4aa1-9fdf-5d19983646e51611739436303-486f4a63-d088-4e38-8b64-e7119d6a8f2f1591176340487-myntra-new-app-icon-3x.png"></a>
                </div>
            </div>
            <div id="reactPageContent" class="header-tb-margin">
                <div class="enroll-header">
                    <div class="LazyLoad "
                        style="height: auto; width: 100%; background: rgb(255, 242, 223);">
                        <picture class="img-responsive" style="width: 100%;">
                            <source
                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/4/19/4c42b837-58a8-48c7-ac22-5ff958622d381618836715619-Kiara-Advani-2x-min.png"
                                type="image/webp"><img
                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/4/19/4c42b837-58a8-48c7-ac22-5ff958622d381618836715619-Kiara-Advani-2x-min.png"
                                class="img-responsive preLoad loaded" alt="" title=""
                                style="width: 100%;">
                        </picture>
                    </div>
                </div>
                <div class="enrollment-container">
                    <div class="enroll-welcome-wrapper">
                        <h4>Hi Usman,</h4>
                        <p class="enroll-welcome-subtext">We’re pleased to see your interest in the Insider
                            program.</p>
                        <p class="enroll-welcome-desc">You’re just a few purchases away from your goal!</p>
                    </div>
                    <div class="goal-criteria-wrapper">
                        <div class="goal-criteria-header">
                            <h4>How To Get There</h4>
                            <div class="goal-criteria-logo"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/6/10/ebb06cb9-4640-4be5-a260-a0134cdea3641623267675890-Goal-criteria1-3x.png"
                                    alt="logo" class=""></div>
                        </div>
                        <div class="goal-criteria-container">
                            <div class="criteria-card-wrapper"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/6/10/af3827a0-d814-4adf-9c64-875056c24b571623268092599-Slice-8-3x--1---1-.png">
                                <div class="criteria-card-rpc-container">
                                    <div class="criteria-card-rpc-amount false">₹0</div>
                                    <div class="criteria-card-rpc-text">You’ve Spent</div>
                                </div>
                                <div class="criteria-card-opc-container false">
                                    <div class="criteria-card-opc-amount">₹ 4000</div>
                                    <div class="criteria-card-opc-text">Goal</div>
                                </div>
                            </div>
                            <div class="criteria-break-line"></div>
                            <div class="criteria-card-wrapper"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/6/10/af3827a0-d814-4adf-9c64-875056c24b571623268092599-Slice-8-3x--1---1-.png">
                                <div class="criteria-card-rpc-container">
                                    <div class="criteria-card-rpc-amount false">0/2</div>
                                    <div class="criteria-card-rpc-text">Your Orders</div>
                                </div>
                                <div class="criteria-card-opc-container false">
                                    <div class="criteria-card-opc-amount">2</div>
                                    <div class="criteria-card-opc-text">Goal</div>
                                </div>
                            </div>
                        </div>
                        <div class="info-card-wrapper">
                            <div class="info-dot-icon">i</div>
                            <p class="info-card-text">You need to <strong>shop for ₹4000 more </strong> and
                                place <strong>2 more orders</strong> to reach your goals</p>
                        </div>
                        <div class="ineligible-notes">Note: Recent purchases will only reflect in the goal
                            once the return window is over</div>
                    </div>
                    <div class="benefits-list-wrapper">
                        <h3 class="enroll-title" style="margin-bottom: 32px;">Benefits Of Joining The
                            Program</h3>
                        <div class="benefits-list-container">
                            <div class="benefits-list-item"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/5/27/3e765afa-de7c-44dd-9379-5c12e7a5c6971622109794253-Early-access-to-sale-3x--1-.png"
                                    alt="Early Access to The Sales">
                                <h4>Early Access to The Sales</h4>
                            </div>
                            <div class="benefits-list-item"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/5/27/8cb20882-94ba-464f-9d76-0a4004a52fbe1622110065196-Slice-26-3x.png"
                                    alt="Insider Exclusive Rewards &amp; Benefits">
                                <h4>Insider Exclusive Rewards &amp; Benefits</h4>
                            </div>
                            <div class="benefits-list-item"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/9/2/6e1c32ff-1026-45ff-b86b-7c11c9ccd3211630587839913-Free-shipping-2x.png"
                                    alt="Free Shipping On All Purchases">
                                <h4>Free Shipping On All Purchases</h4>
                            </div>
                        </div>
                    </div>
                    <h3 class="enroll-title">How does it work</h3>
                    <div class="enroll-earn-text">
                        <div>Earn SuperCoins with every purchase.</div>
                        <div>You can get upto 3 SuperCoins for every ₹100 spent</div>
                    </div>
                    <div class="enroll-earn-wrapper">
                        <div class="enroll-earn-container"><img
                                src="https://assets.myntassets.com/assets/images/retaillabs/2023/8/9/598ddcfd-f054-44f7-8896-7915f08693d41691556606173-Frame-675.png"
                                alt="tiers"></div>
                        <div class="enroll-earn-upgrade-container">
                            <div class="enroll-earn-upgrade"><img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2021/5/27/1ff784f4-042a-430e-8b0e-acbb8d9d365e1622110908935-Upgrade-3x.png">
                                <p>Shop on Myntra to Upgrade your tier</p>
                            </div>
                        </div>
                    </div>
                    <div class="reward-wrapper">
                        <h3 class="enroll-title" style="margin-bottom: 0px;">Rewards</h3>
                        <div class="enroll-reward-text">Use your SuperCoins to get exciting rewards</div>
                        <div class="reward-slider">
                            <div class="reward-card-wrapper">
                                <div class="reward-card-image">
                                    <div class="LazyLoad "
                                        style="height: auto; width: 100%; background: rgb(229, 241, 255);">
                                        <picture class="img-responsive" style="width: 100%;">
                                            <source
                                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/74e9ae39-2302-42e7-ad8c-917e51b2206c1630656211389-Get-Myntra-Voucher-worth-Rs.500.jpg"
                                                type="image/webp"><img
                                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/74e9ae39-2302-42e7-ad8c-917e51b2206c1630656211389-Get-Myntra-Voucher-worth-Rs.500.jpg"
                                                class="img-responsive preLoad loaded" alt=""
                                                title="" style="width: 100%;">
                                        </picture>
                                    </div>
                                </div>
                                <div class="reward-card-info">
                                    <p class="reward-card-title">Get Myntra Voucher worth Rs.500</p>
                                </div>
                            </div>
                            <div class="reward-card-wrapper">
                                <div class="reward-card-image">
                                    <div class="LazyLoad "
                                        style="height: auto; width: 100%; background: rgb(255, 237, 243);">
                                        <picture class="img-responsive" style="width: 100%;">
                                            <source
                                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/4ef867c9-1129-4e3c-98c8-b67711845e421630656211382-Get-Leivs-Voucher-worth-Rs.-500.jpg"
                                                type="image/webp"><img
                                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/4ef867c9-1129-4e3c-98c8-b67711845e421630656211382-Get-Leivs-Voucher-worth-Rs.-500.jpg"
                                                class="img-responsive preLoad loaded" alt=""
                                                title="" style="width: 100%;">
                                        </picture>
                                    </div>
                                </div>
                                <div class="reward-card-info">
                                    <p class="reward-card-title">Get Levi's Voucher worth Rs. 500</p>
                                </div>
                            </div>
                            <div class="reward-card-wrapper">
                                <div class="reward-card-image">
                                    <div class="LazyLoad "
                                        style="height: auto; width: 100%; background: rgb(229, 241, 255);">
                                        <picture class="img-responsive" style="width: 100%;">
                                            <source
                                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/935ad8e3-121b-41d1-abd1-1200ad4dda531630656211396-Get-SonyLiv-Premium-1-Month-Subscription.jpg"
                                                type="image/webp"><img
                                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/935ad8e3-121b-41d1-abd1-1200ad4dda531630656211396-Get-SonyLiv-Premium-1-Month-Subscription.jpg"
                                                class="img-responsive preLoad loaded" alt=""
                                                title="" style="width: 100%;">
                                        </picture>
                                    </div>
                                </div>
                                <div class="reward-card-info">
                                    <p class="reward-card-title">Get SonyLiv Premium 1 Month Subscription
                                    </p>
                                </div>
                            </div>
                            <div class="reward-card-wrapper">
                                <div class="reward-card-image">
                                    <div class="LazyLoad "
                                        style="height: auto; width: 100%; background: rgb(255, 237, 243);">
                                        <picture class="img-responsive" style="width: 100%;">
                                            <source
                                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/ad73203d-eadf-4539-afff-8d9de0f121d61630656211403-Get-Tokyo-Talkies-Voucher-worth-Rs.400.jpg"
                                                type="image/webp"><img
                                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/ad73203d-eadf-4539-afff-8d9de0f121d61630656211403-Get-Tokyo-Talkies-Voucher-worth-Rs.400.jpg"
                                                class="img-responsive preLoad loaded" alt=""
                                                title="" style="width: 100%;">
                                        </picture>
                                    </div>
                                </div>
                                <div class="reward-card-info">
                                    <p class="reward-card-title">Get Tokyo Talkies Voucher worth Rs.400</p>
                                </div>
                            </div>
                            <div class="reward-card-wrapper">
                                <div class="reward-card-image">
                                    <div class="LazyLoad "
                                        style="height: auto; width: 100%; background: rgb(244, 255, 249);">
                                        <picture class="img-responsive" style="width: 100%;">
                                            <source
                                                srcset="//assets.myntassets.com/f_webp,dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/258492c4-99f1-4a49-a416-c6e26303d82c1630656211377-Get-FLAT-12--OFF-on-Flipkart-Flight--Bookings.jpg"
                                                type="image/webp"><img
                                                src="//assets.myntassets.com/dpr_1.5,q_60,w_400,c_limit,fl_progressive/assets/images/retaillabs/2021/9/3/258492c4-99f1-4a49-a416-c6e26303d82c1630656211377-Get-FLAT-12--OFF-on-Flipkart-Flight--Bookings.jpg"
                                                class="img-responsive preLoad loaded" alt=""
                                                title="" style="width: 100%;">
                                        </picture>
                                    </div>
                                </div>
                                <div class="reward-card-info">
                                    <p class="reward-card-title">Get FLAT 12% OFF on Flipkart Flight
                                        Bookings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="enroll-fashion-wrapper">
                        <div class="enroll-fashion-logo"><img
                                src="https://assets.myntassets.com/assets/images/retaillabs/2021/1/27/fbf63764-46e8-4aa1-9fdf-5d19983646e51611739436303-486f4a63-d088-4e38-8b64-e7119d6a8f2f1591176340487-myntra-new-app-icon-3x.png"
                                alt="myntra logo"><img
                                src="https://assets.myntassets.com/assets/images/retaillabs/2021/7/13/fd694523-c75d-46ac-babc-27d94e7807ab1626184638366-Slice-30-3x.png"
                                alt="myntra insider"></div>
                        <p>Fashion Advice | VIP Access | Extra Savings</p>
                    </div>
                </div>
                <div class="enroll-btn-wrapper"><button class="enroll-btn">CONTINUE SHOPPING</button>
                </div>
            </div>
        </div>
    </div> --}}
</body>

</html>
