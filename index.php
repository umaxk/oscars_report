<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy"
        content="default-src * 'unsafe-inline' 'unsafe-eval' data: gap: https://ssl.gstatic.com 'unsafe-eval'; style-src 'self' 'unsafe-inline'; media-src *; img-src * 'unsafe-inline' 'unsafe-eval' data: content:;">
    <meta name="format-detection" content="telephone=no">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover">
    <meta name="color-scheme" content="light dark">
    <link href="css/font/rubik.css" rel="stylesheet">
    <link rel="stylesheet" href="css/lib/bootstrap.css">
    <link rel="stylesheet" href="css/def/fl.css">
    <link rel="stylesheet" href="css/def/select-ios.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/init.css">
    <link rel="stylesheet" href="css/list/main.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/car.css">
    <link rel="stylesheet" href="css/lib/checkboxios.css">

    <link rel="stylesheet" href="css/load.css">

    <title>CarVibe отчет</title>
</head>
<style>
.app{
    margin:auto;
    max-width:400px;
    margin-top: 20px;
    margin-bottom: 50px;
}
</style>
<body>
    <div class="app">
        <dlist :list="list" mod="1" :see="see"></dlist>
    </div>
    <script src="/js/lib/axios.min.js"></script>
    <script src="/js/lib/vue.js"></script>
    <script src="/app/component/dlist2/build.js?e=<?=((int) microtime(true))?>"></script>
    <script>
        var hash = '<?=str_replace(['/', '"', "'", ',', '.'], '', $_GET['_url'])?>';
        var app = new Vue({
            el: '.app',
            data: {
                see: [],
                list: {},
            },
            created: function () {
                this.get();
            },
            methods: {
                get: function () {
                    axios.get('https://oscars.rj28.ru/api/v1/public/report/'+hash+'/').then(function (response) {
                        if (response.data.status) {
                            app.list = response.data.data.data;
                        }
                        else {
                            alert(response.data.message);
                        }
                    }).catch(function (error) {
                        alert(error);
                    });
                }
            }
        });
    </script>
</body>
</html>