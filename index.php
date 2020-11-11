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

<body>
    <div class="app">
        <dlist :list="list" mod="1" :see="see"></dlist>
    </div>
    <style>
        /*body {
            background-color: #e5e5e5;
            margin: 0 auto;
            font-family: "Rubik", sans-serif !important;
            background-color: #fafafa;
        }
        .app{
            margin:auto;
            max-width:500px;
            margin-bottom: 50px;
            padding: 5px 20px 10px 20px;
        }*/
        .app{
            margin:auto;
            max-width:400px;
            margin-top: 20px;
        }
    </style>
    <script src="/js/lib/axios.min.js"></script>
    <script src="/js/lib/vue.js"></script>
    <script src="/app/component/dlist2/bbuild.js?e=<?=((int)microtime(true))?>"></script>
    <script>
        var hash = '<?=str_replace(['/', '"', "'", ',', '.'], '', $_GET['_url'])?>';
        var app = new Vue({
            el: '.app',
            data: {
                see: [],
                list: {
                    photo_list:[],
                    video_list:{
                        review:{
                            url:'#'
                        },
                        test_drive:{
                            url:'#'
                        }
                    }
                },
                block:{
		            def:{},
		            morda_top:{},
		            fara_top_left:{},
		            fara_top_right:{},
		            kapot:{},
		            lobash_top:{},
		            top:{},
		            lobash_bottom:{},
		            bagaj:{},
		            polosa_bottom:{},
		            morda_bottom:{},
		            fara_bottom_left:{},
		            fara_bottom_right:{},
		            guba_bottom:{},
		            krilo_left_top:{},
		            koleso_left_top:{},
		            stoika_left_top:{},
		            steklo_left_top:{},
		            dver_left_top:{},
		            zerkalo_left:{},
		            porog_left:{},
		            stoika_left:{},
		            steklo_left_bottom:{},
		            dver_left_bottom:{},
		            stoika_left_bottom:{},
		            krilo_left_bottom:{},
		            koleso_left_bottom:{},
		            krilo_right_top:{},
		            koleso_right_top:{},
		            stoika_right_top:{},
		            steklo_right_top:{},
		            dver_right_top:{},
		            zerkalo_right:{},
		            stoika_right:{},
		            porog_right:{},
		            steklo_right_bottom:{},
		            dver_right_bottom:{},
		            stoika_right_bottom:{},
		            krilo_right_bottom:{},
		            koleso_right_bottom:{}
		        },
		        defcar:{
		            prefix:'',
		            name:'',
		            comment:'',
		            type:0,
		            img:''
		        },
            },
            created: function () {


                this.get();

            },
            methods: {
                fix_null: function (d) {
                    var e = [];
                    if (i in d) {
                        if (d[i] == null && d[i].length != 0 ) {
                            e.push(d[i]);
                        }
                    }

                    return e;
                },
                get: function () {
                    axios.get('https://oscars.rj28.ru/api/v1/public/report/'+hash+'/').then(function (response) {
                        if (response.data.status) {
                            app.list = response.data.data.data;
                            if (response.data.data.data['block'] == null) {
                            	//app.list['block'] = app.block;
                            }
                            console.log(response.data.data);
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