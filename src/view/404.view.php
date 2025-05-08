<div id="leaves">
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
</div>
<section class="bg-white dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center" style="background-image: url('<?php echo BASE_PATH; ?>/public/images/404.jpg');">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">404</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Something's missing.</p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that page. You'll find lots to explore on the home page. </p>
                <a href="<?php echo BASE_PATH; ?>" class="inline-flex text-black bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back to Homepage</a>
            </div>
        </div>
</section>
<style>
    body {
        background: #fff;
    }

    /* leaf animations */

    #leaves {
        position: relative;
        top: -50px;
        width: 100%;
        text-align: right;
    }

    #leaves i {
        display: inline-block;
        width: 200px;
        height: 150px;
        background: linear-gradient(to bottom right, #309900, #005600);
        transform: skew(20deg);
        border-radius: 5% 40% 70%;
        box-shadow: inset 0px 0px 1px #222;
        border: 1px solid #333;
        z-index: 1;
        -webkit-animation: falling 5s 0s infinite;
    }

    #leaves i:nth-of-type(2n) {
        -webkit-animation: falling2 5s 0s infinite;
    }

    #leaves i:nth-of-type(3n) {
        -webkit-animation: falling3 5s 0s infinite;
    }

    #leaves i:before {
        position: absolute;
        content: '';
        top: 117px;
        right: 9px;
        height: 27px;
        width: 32px;
        transform: rotate(49deg);
        border-radius: 0% 15% 15% 0%;
        border-top: 1px solid #222;
        border-bottom: 1px solid #222;
        border-left: 0px solid #222;
        border-right: 1px solid #222;
        background: linear-gradient(to right, rgba(0, 100, 0, 1), #005600);
        z-index: 1;
    }

    #leaves i:after {
        content: '';
        height: 125px;
        width: 10px;
        background: linear-gradient(to right, rgba(0, 0, 0, .15), rgba(0, 0, 0, 0));
        display: block;
        transform: rotate(125deg);
        position: absolute;
        left: 85px;
        border-radius: 50%;
    }


    #leaves i:nth-of-type(n) {
        height: 23px;
        width: 30px;
    }

    #leaves i:nth-of-type(n):before {
        width: 7px;
        height: 5px;
        top: 17px;
        right: 1px;
    }

    #leaves i:nth-of-type(n):after {
        width: 2px;
        height: 17px;
        left: 12px;
        top: 0px;
    }

    #leaves i:nth-of-type(2n+1) {
        height: 11px;
        width: 16px;
    }

    #leaves i:nth-of-type(2n+1):before {
        width: 4px;
        height: 3px;
        top: 7px;
        right: 0px;
    }

    #leaves i:nth-of-type(2n+1):after {
        width: 2px;
        height: 6px;
        left: 5px;
        top: 1px;
    }

    #leaves i:nth-of-type(3n+2) {
        height: 17px;
        width: 23px;
    }

    #leaves i:nth-of-type(3n+2):before {
        height: 4px;
        width: 4px;
        top: 12px;
        right: 1px;
    }

    #leaves i:nth-of-type(3n+2):after {
        height: 10px;
        width: 2px;
        top: 1px;
        left: 8px;
    }

    #leaves i:nth-of-type(n) {
        -webkit-animation-delay: 1.9s;
    }

    #leaves i:nth-of-type(2n) {
        -webkit-animation-delay: 3.9s;
    }

    #leaves i:nth-of-type(3n) {
        -webkit-animation-delay: 2.3s;
    }

    #leaves i:nth-of-type(4n) {
        -webkit-animation-delay: 4.4s;
    }

    #leaves i:nth-of-type(5n) {
        -webkit-animation-delay: 5s;
    }

    #leaves i:nth-of-type(6n) {
        -webkit-animation-delay: 3.5s;
    }

    #leaves i:nth-of-type(7n) {
        -webkit-animation-delay: 2.8s;
    }

    #leaves i:nth-of-type(8n) {
        -webkit-animation-delay: 1.5s;
    }

    #leaves i:nth-of-type(9n) {
        -webkit-animation-delay: 3.3s;
    }

    #leaves i:nth-of-type(10n) {
        -webkit-animation-delay: 2.5s;
    }

    #leaves i:nth-of-type(11n) {
        -webkit-animation-delay: 1.2s;
    }

    #leaves i:nth-of-type(12n) {
        -webkit-animation-delay: 4.1s;
    }

    #leaves i:nth-of-type(13n) {
        -webkit-animation-delay: 1s;
    }

    #leaves i:nth-of-type(14n) {
        -webkit-animation-delay: 4.7s;
    }

    #leaves i:nth-of-type(15n) {
        -webkit-animation-delay: 3s;
    }

    #leaves i:nth-of-type(n) {
        background: linear-gradient(to bottom right, #309900, #005600);
    }

    #leaves i:nth-of-type(2n+2) {
        background: linear-gradient(to bottom right, #5e9900, #2b5600);
    }

    #leaves i:nth-of-type(4n+1) {
        background: linear-gradient(to bottom right, #990, #564500);
    }

    #leaves i:nth-of-type(n) {
        opacity: .7;
    }

    #leaves i:nth-of-type(3n+1) {
        opacity: .5;
    }

    #leaves i:nth-of-type(3n+2) {
        opacity: .3;
    }

    #leaves i:nth-of-type(n) {
        transform: rotate(180deg);
    }


    #leaves i:nth-of-type(n) {
        -webkit-animation-timing-function: ease-in-out;
    }

    @-webkit-keyframes falling {

        0% {
            -webkit-transform:
                translate3d(300, 0, 0) rotate(0deg);
        }

        100% {
            -webkit-transform:
                translate3d(-350px, 700px, 0) rotate(90deg);
            opacity: 0;
        }
    }

    @-webkit-keyframes falling3 {
        0% {
            -webkit-transform:
                translate3d(0, 0, 0) rotate(-20deg);
        }

        100% {
            -webkit-transform:
                translate3d(-230px, 640px, 0) rotate(-70deg);
            opacity: 0;
        }
    }

    @-webkit-keyframes falling2 {
        0% {
            -webkit-transform:
                translate3d(0, 0, 0) rotate(90deg);
        }

        100% {
            -webkit-transform:
                translate3d(-400px, 680px, 0) rotate(0deg);
            opacity: 0;
        }
    }
</style>