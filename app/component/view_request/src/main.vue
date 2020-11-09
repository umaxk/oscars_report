<template>
<div class="dlist-main">
    <div class="dlist-header">
        <img :src="'./img/dlist/logo.svg'" alt="ОСКАРС" />
    </div>
    <div class="dlist-informer-level1">
        <h2>
            Диагностический лист
            <br />
            <span class="dlist-bold" v-html="list.gos_number"></span>
        </h2>
        <div class="dlist-informer-car" v-html="
          vi(list.brand) +
          ' ' +
          vi(list.model) +
          ' ' +
          vi(list.generation) +
          ' ' +
          vi(list.year)
        ">
            <span class="point-animation">
                <span :key="k" v-for="(v, k) in 25">&nbsp;</span>
            </span>
        </div>
        <div class="dlist-informer-gray-text" v-html="list.location_street">
            <span class="point-animation">
                <span :key="k" v-for="(v, k) in 25">&nbsp;</span>
            </span>
        </div>
        <div class="dlist-informer-gray-text" v-html="(mod == 1 && list.created == '') ? emp() : list.created">
            30.09.2020
        </div>
        <div class="dlist-informer-expert">
            <span class="dlist-informer-gray-text">Эксперт: </span>
            <span class="dlist-informer-black-text" v-html="(mod == 1 && list.expert == '') ? 'Вы' : list.expert"></span>
        </div>
        <!-- logo -->
        <div class="dlist-informer-photo">
            <div :key="kk" v-for="(i,kk) in this.list.photo_list" :style="get_background(i.img)" class="e-pic-v1"></div>

            <!--<div class="swyper">
                <div class="photo-swyper photo-left" @click="swype_pic('-')">
                    <span>&#10094;</span>
                </div>
                <div class="photo-swyper photo-right" @click="swype_pic('+')">
                    <span>&#10095;</span>
                </div>
            </div>-->
        </div>
        <!--
        <div class="dlist-position-count-photo">
            <span class="dlist-informer-gray-text" v-html="
            iphoto + ' из ' + (count_photo != undefined ? count_photo : 0)
          ">1 из
            </span>
        </div>-->
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-price">
        <h2 class="dlist-informer-black-text dlist-bold">Стоимость</h2>
        <div class="dlist-price-table">
            <div class="dlist-price-v1" v-show="list.price > 0">
                <span class="dlist-informer-gray-text">До торга</span>
                <br />
                <span class="dlist-informer-green-text dlist-bold" v-html="list.price + ' ₽'">99999999 р</span>
            </div>
            <div class="dlist-price-v1" v-show="list.price_sale > 0">
                <span class="dlist-informer-gray-text">После торга</span>
                <br />
                <span class="dlist-informer-green-text dlist-bold" v-html="list.price_sale + ' ₽'">99999999 р</span>
            </div>
        </div>
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-table" :key="kct" v-for="(vct, kct) in config_top">
        <div class="dist-table-header" v-html="vct.name">Основная информация</div>
        <div class="dlist-table-container" :key="kctl" v-for="(vctl, kctl) in vct.list">
            <div class="dlist-table-block-v1">
                <span class="dlist-informer-gray-text" v-html="vctl.name"></span>
            </div>
            <div class="dlist-table-block-v1">
                <span class="dlist-informer-black-text" v-html="get_data_table(vctl.field)"></span>
            </div>
        </div>
        <div class="dlist-hr">
            <hr />
        </div>
    </div>

    <div class="dlist-complect dlist-table">
        <div class="dist-table-header">Комплектация</div>
        <ul class="dlist-ul">
            <li :key="kk" v-for="(vk, kk) in convert_checker(list.equipment_check)">
                <span v-html="vk.name"></span>
            </li>
        </ul>
        <!--
        <a  @click="!show_compl" v-if="convert_checker(list.equipment_check).length > 5" v-html="!show_compl?'Показать все':'Скрыть'"></a>-->
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-check-auto">
        <div class="dist-table-header" style="font-size: 25px">
            Проверка автомобиля
        </div>
        <!-- -->
        <div class="dlist-check-point" :key="kt" v-for="(vt, kt) in convert_tester(list.equipment_tests)">
            <div class="dlist-check-title" v-html="vt.name">Электрика</div>
            <div class="dlist-check-list" :key="kti" v-for="(vti, kti) in vt.list">
                <div class="dlist-check-status">
                    <!-- -->
                    <img :src="'./img/dlist/' + vti.img + '.svg'" alt="" />
                    <!-- -->
                </div>
                <div class="dlist-check-text" v-html="vti.name">
                    Индикация Check engine
                </div>
            </div>
        </div>
        <!-- -->
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-plus-minus">
        <div class="dlist-block" :key="kp" v-for="(vp, kp) in convert_pl(list.equipment_check_pl)">
            <div :class="'dist-table-header ' + (kp == 0 ? 'green' : 'red')" v-html="vp.name"></div>
            <ul class="dlist-ul">
                <li :key="kpl" v-for="(vpl, kpl) in vp.list">
                    <span v-html="vpl">Круиз контроль</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-video">
        <div class="dist-table-header">Видео осмотра</div>

        <video controls="controls" :poster="'./img/dlist/def.jpg'" width="100%" height="200">
            <source :src="list.video_list.review.url" type="video/mp4" />
        </video>
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-video">
        <div class="dist-table-header">Видео тест-драйва</div>

        <video controls="controls" :poster="'./img/dlist/def.jpg'" width="100%" height="200">
            <source :src="list.video_list.test_drive.url" type="video/mp4" />
        </video>
    </div>

    <div class="dlist-hr">
        <hr />
    </div>

    <div class="dlist-comment">
        <div class="dist-table-header" style="font-size: 25px">
            Комментарий эксперта
        </div>
        <div class="dlist-comment-text" v-html="list.comment">

        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    props: {
        mod: [Number, String],
        field: String,
        equipment: [Array, Object],
        list: [Object, Array],
        see: [Object, Array],
    },
    data: function () {
        return {
            pic: "#",
            iphoto: 1,
            show_compl: false,
            mode: this.mod,
            config_top: [{
                    name: "Основная информация",
                    list: [{
                            name: "Год выпуска",
                            field: ["year"],
                        },
                        {
                            name: "Цвет",
                            field: ["color"],
                        },
                        /*{
                                        name:'Кузов',
                                        field:['body']
                                    },*/
                        {
                            name: "Кузов",
                            field: ["color"],
                        },
                        {
                            name: "Двигатель",
                            field: ["size_engine", "type_engine"],
                        },
                        {
                            name: "Руль",
                            field: ["type_wheel"],
                        },
                        {
                            name: "Состояние",
                            field: ["damage"],
                        },
                    ],
                },

                {
                    name: "Данные по ПТС",
                    list: [{
                            name: "Тип ПТС",
                            field: ["type_pts"],
                        },
                        {
                            name: "Дата выдачи",
                            field: ["date_end"],
                        },
                        {
                            name: "Количество хозяев по ПТС",
                            field: ["count_owner"],
                        },
                        {
                            name: "Свободных мест в ПТС",
                            field: ["free_space"],
                        },
                    ],
                },

                {
                    name: "Прочее",
                    list: [{
                            name: "Сервисная книжка",
                            field: ["service_book"],
                        },
                        {
                            name: "На гарантии",
                            field: ["guarantee"],
                        },
                        {
                            name: "Где куплена",
                            field: ["where_purchased"],
                        },
                        {
                            name: "Колличество ключей",
                            field: ["count_keys"],
                        },
                        {
                            name: "Шины",
                            field: ["tires"],
                        },
                        {
                            name: "Размер покрышек",
                            field: ["size_tires"],
                        },
                        {
                            name: "Второй комплект колес",
                            field: ["second_tires"],
                        },
                        {
                            name: "Оформлен на Ю.Л.",
                            field: ["legal_entity"],
                        },
                        {
                            name: "Ошибки ЭБУ",
                            field: ["errors"],
                        },
                        {
                            name: "Спидометр",
                            field: ["speedometer"],
                        },
                    ],
                },
            ],
        };
    },
    created: () => {
        //this.iphoto = 1;
    },
    computed: {
        count_photo: function () {
            return this.list.photo_list.length;
        },
        get_pic: function () {
            if (this.list.photo_list.length > 0) {
                return (
                    'background-image: url("' +
                    this.list.photo_list[this.iphoto - 1].img +
                    '");'
                );
            } else {
                return 'background-image: url("#");';
            }
        },
    },
    methods: {
        get_background: function (d) {
            return 'background-image: url(' + d + ');';
        },
        /**
         * @var d array
         */
        convert_pl: function (d) {
            var p = [];
            var m = [];
            for (var i = 0; i < d.length; i = i + 1) {
                if (d[i] != null) {
                    if (Object.keys(d[i]).length != 0) {
                        if (d[i].path == "Плюсы") {
                            p.push(d[i].name);
                        } else {
                            m.push(d[i].name);
                        }
                    }
                }
            }

            return [{
                    name: "Плюсы",
                    list: p,
                },
                {
                    name: "Минусы",
                    list: m,
                },
            ];
        },
        convert_tester: function (d) {
            var l = []; // собираю список
            var t = []; // собираю тайтл
            var r = []; // результат
            var s = -1; // поисковой индекс
            for (var i = 0; i < d.length; i = i + 1) {
                if (d[i] != null) {
                    if (Object.keys(d[i]).length != 0) {
                        s = t.indexOf(d[i].path);
                        if (s === -1) {
                            t.push(d[i].path);
                            s = t.length - 1;
                        }
                        if (l[s] == undefined) {
                            l[s] = [];
                        }
                        l[s].push({
                            name: d[i].name,
                            status: d[i].val.id,
                            img: d[i].val.id == 1 ? "ok" : "err",
                        });
                    }
                }
            }

            for (i in t) {
                r.push({
                    name: t[i],
                    list: l[i],
                });
            }

            return r;
        },
        convert_checker: function (data) {
            var list = [];
            console.log(data);
            for (var i = 0; i < data.length; i = i + 1) {
                if (data[i] != null) {
                    if (
                        Object.keys(data[i]).length != 0 &&
                        data[i] != "" &&
                        data[i] != null &&
                        data[i] !== undefined
                    ) {
                        list.push(data[i]);
                    }
                }
            }

            return list;
        },
        get_data_table: function (n) {
            var c = "";
            if (n.length > 0) {
                if (typeof n == Array) {
                    for (i in n) {
                        c = c + this.vi(this.list[n[i]]) + " ";
                    }
                } else {
                    c = c + this.vi(this.list[n]) + " ";
                }

            }

            return c;
        },
        swype_pic: function (m) {
            if (m == "+") {
                if (this.iphoto + 1 <= this.list.photo_list.length) {
                    this.iphoto = this.iphoto + 1;
                }
            } else {
                if (this.iphoto - 1 > 0) {
                    this.iphoto = this.iphoto - 1;
                }
            }

            return;
        },
        vi: function (t) {
            if (this.mod == 1) {
                if (t != "") {
                    if (typeof t === "object") {
                        return t["name"];
                    }
                }
            }

            if (t == "" || t == undefined) {
                return this.emp(5);
            }

            return t;
        },
        emp: function (size = 25) {
            var e = '<span class="point-animation">';
            for (var i = 0; i < size; i++) {
                e = e + "<span>&nbsp;</span>";
            }
            e = e + "</span>";

            return e;
        },
    },
};
</script>

<style>
.dlist-main {
    margin: auto;
    min-width: 315px;
    padding: 0px 10px 0px 10px;
}

h2 {
    color: #000;
}

.dlist-header {
    width: 100%;
    height: 50px;
    text-align: center;
    margin: auto;
    background-color: #000;
}

.dlist-header>img {
    margin-top: 15px;
}

.dlist-informer-level1 {
    margin-top: 15px;
}

.dlist-informer-level1>h2 {
    font-size: 30px;
}

.dlist-informer-level1>h2>span {
    color: #bed134;
}

.dlist-informer-car {
    margin-top: 0px;
    font-size: 18px;
    color: #000;
}

.dlist-informer-gray-text {
    font-size: 16px;
    color: #b5b5b5;
}

.dlist-informer-black-text {
    font-size: 16px;
    color: #000;
}

.dlist-informer-green-text {
    font-size: 20px;
    color: #bed134;
}

.dlist-bold {
    font-weight: bold;
}

.dlist-informer-photo {
    width: 100%;
    height: 255px;
    background-image: url("#");
    background-position: center;
    background-size: cover;
    margin-top: 10px;
    display: flex;
    overflow: auto;
}

.dlist-position-count-photo {
    padding: 15px;
    padding-bottom: 0px;
}

.dlist-hr {
    width: 99%;
    margin: auto;
}

.dlist-hr>hr {
    background-color: #b5b5b5;
    color: #b5b5b5;
}

.dlist-price-table {
    display: flex;
}

.dlist-price-v1 {
    width: 50%;
}

.dlist-table {
    margin-bottom: 15px;
}

.dlist-table-container {
    width: 100%;
    display: flex;
    padding-top: 10px;
}

.dlist-table-block-v1 {
    width: 50%;
    overflow: hidden;
    white-space: pre-line;
}

.dist-table-header {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    padding-bottom: 5px;
}

ul {
    padding-left: 15px;
}

.dlist-ul>li {
    color: #bed134;
    padding-bottom: 5px;
}

.dlist-ul>li>span {
    font-size: 16px;
    color: #000;
}

.dlist-complect>a {
    color: #bed134;
    padding-top: 5px;
}

.dlist-check-title {
    font-weight: bold;
    font-size: 18px;
    padding-bottom: 15px;
}

.dlist-check-status>img,
svg {
    height: 18px;
}

.dlist-check-list {
    display: flex;
    padding-bottom: 10px;
}

.dlist-check-status {
    width: 30px;
}

.dlist-check-text {
    font-size: 16px;
}

.green {
    color: #bed134;
}

.red {
    color: #d13434;
}

.e-pic-v1 {
    width: 95%;
    height: 235px;
    border-radius: 10px;
    min-width: 400px;
    background-size: cover;
    background-position: center;
    margin-right: 10px;
}

.point-animation {
    border-radius: 5px;
    background: linear-gradient(41deg, #ffffff, #aeaeae, #5ba67d);
    background-size: 600% 600%;
    -webkit-animation: AnimationName 4s ease infinite;
    -moz-animation: AnimationName 4s ease infinite;
    animation: AnimationName 4s ease infinite;
}

@-webkit-keyframes AnimationName {
    0% {
        background-position: 88% 0%;
    }

    50% {
        background-position: 13% 100%;
    }

    100% {
        background-position: 88% 0%;
    }
}

@-moz-keyframes AnimationName {
    0% {
        background-position: 88% 0%;
    }

    50% {
        background-position: 13% 100%;
    }

    100% {
        background-position: 88% 0%;
    }
}

@keyframes AnimationName {
    0% {
        background-position: 88% 0%;
    }

    50% {
        background-position: 13% 100%;
    }

    100% {
        background-position: 88% 0%;
    }
}

.photo-swyper {
    width: 11px;
    height: 28px;
    margin-top: 110px;
    color: #fff;
    padding: 12px 5px 10px 1px;
    cursor: pointer;
}

.photo-swyper>span {}

.photo-left {
    float: left;
}

.photo-right {
    float: right;
}
</style>
