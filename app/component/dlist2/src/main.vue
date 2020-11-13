<template>
<div class="dlist_main">
    <div class="">
        <!-- header -->
        <div class="d_container d_header">
            <h2>Диагностический лист</h2>
            <!-- марка модель генерация год-->
            <p v-html="
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
            </p>
            <!-- локация осмотра -->
            <span v-html="list.location_street">
                <span class="point-animation">
                    <span :key="k" v-for="(v, k) in 25">&nbsp;</span>
                </span>
            </span>
        </div>
        <!-- gallery -->
        <div class="d_container_g d_gallery" v-if="list.photo_list.length > 0">
            <div class="d_informer_photo">
                <div class="e_pic_v1" :key="kk" v-for="(i, kk) in list.photo_list" :style="get_background(i.img)" @click="show_galery(list.photo_list, kk)"></div>
            </div>
        </div>

        <!-- -->

        <div class="d_container d_block_expert_time">
            <div class="d_expert" v-html="'Эксперт: ' + (list.expert == '' ? '-' : list.expert)">
                Эксперт: Роман Рыбкин
            </div>
            <div class="d_time" v-html="
            mod == 1 && list.created == '' ? emp() : convert_date(list.created)
          ">
                00:00 01.01.2020
            </div>
        </div>

        <div class="dlist_hr">
            <hr />
        </div>
        <!-- -->
        <!-- Стоимость -->
        <div class="d_container dlist_table" v-if="list.price != '' || list.price_sale != ''">
            <div class="dist_table_header">Стоимость</div>
            <div class="dlist_table_container" v-if="list.price != ''">
                <div class="dlist_table_block_v1">
                    <span class="dlist_informer_gray_text">До торга</span>
                </div>
                <div class="dlist_table_block_v1">
                    <span class="dlist_informer_black_text" v-html="list.price + ' ₽'">2020
                    </span>
                </div>
            </div>
            <div class="dlist_table_container" v-if="list.price_sale != ''">
                <div class="dlist_table_block_v1">
                    <span class="dlist_informer_gray_text">После торга</span>
                </div>
                <div class="dlist_table_block_v1">
                    <span class="dlist_informer_black_text" v-html="list.price_sale + ' ₽'">2020
                    </span>
                </div>
            </div>
        </div>

        <div class="d_container dlist_table" :key="kct" v-for="(vct, kct) in config_top">
            <div class="dist_table_header" v-html="vct.name">
                Основная информация
            </div>
            <div class="dlist_table_container" :key="kctl" v-for="(vctl, kctl) in vct.list">
                <div class="dlist_table_block_v1" v-if="get_data_table(vctl.field) != ''">
                    <span class="dlist_informer_gray_text" v-html="vctl.name">Год выпуска</span>
                </div>
                <div class="dlist_table_block_v1" v-if="get_data_table(vctl.field) != ''">
                    <span class="dlist_informer_black_text" v-html="get_data_table(vctl.field)">2020
                    </span>
                </div>
            </div>
        </div>
        <!-- -->
        <!--<div class="d_container d_position_btn">
            <div class="btn_gray">Смотреть все характеристики авто</div>
        </div>-->
        <!-- -->

        <div class="dlist_hr_v2">
            <hr />
        </div>

        <!--
        <div class="d_container dlist_table">
            <div class="dist_table_header">Отчет о прверке по VIN</div>

            <div class="dlist_table_container">
                <div class="dlist_table_block_v2_l">
                    <img :src="'./img/dlist/ok.svg'" alt="ok" />
                </div>
                <div class="dlist_table_block_v2_r">
                    <span class="dlist_informer_black_text">3 владельца по птс</span>
                </div>
            </div>
            <div class="dlist_table_container">
                <div class="dlist_table_block_v2_l">
                    <img :src="'./img/dlist/ok.svg'" alt="ok" />
                </div>
                <div class="dlist_table_block_v2_r">
                    <span class="dlist_informer_black_text">3 владельца по птс</span>
                </div>
            </div>
            <div class="dlist_table_container">
                <div class="dlist_table_block_v2_l">
                    <img :src="'./img/dlist/err.svg'" alt="err" />
                </div>
                <div class="dlist_table_block_v2_r">
                    <span class="dlist_informer_black_text">Есть юридические ограничения</span>
                </div>
            </div>
            <div class="dlist_table_container">
                <div class="dlist_table_block_v2_l">
                    <img :src="'./img/dlist/err.svg'" alt="err" />
                </div>
                <div class="dlist_table_block_v2_r">
                    <span class="dlist_informer_black_text">Есть юридические ограничения</span>
                </div>
            </div>
            <div class="dlist_table_container">
                <div class="dlist_table_block_v2_l">
                    <img :src="'./img/dlist/err.svg'" alt="err" />
                </div>
                <div class="dlist_table_block_v2_r">
                    <span class="dlist_informer_black_text">Есть юридические ограничения</span>
                </div>
            </div>
        </div>

        <div class="d_container d_position_btn">
            <div class="btn_green">Смотреть полный отчет</div>
        </div>

        <div class="dlist_hr_v2">
            <hr />
        </div>-->
        <!-- -->

        <div class="d_container d_car">
            <div class="dist_table_header">Повреждения</div>
            <div class="d_inform_car">
                Нажмите на элемент, чтобы посмотреть повреждение, или воспользуйтесь
                слайдером.
            </div>
            <div class="d_car_c_v1">
                <!-- car rrr-->
                <div class="cardemo" v-if="show_car()">
                    <!--<div class="dist-table-header" style="font-size: 25px">
                        Развертка автомобиля
                    </div>-->
                    <div class="view_img" v-if="show_car_info">
                        <div class="view_img_close">
                            <span @click="show_car_info = false">Закрыть</span>
                        </div>
                        <div class="view_img_img" v-if="see_car_info.img != ''">
                            <img :src="see_car_info.img" alt="" />
                        </div>
                        <div class="view_img_text">
                            <span>{{ see_car_info.text }}</span>
                        </div>
                    </div>

                    <div class="fix-position r-h">
                        <div class="carcar">
                            <div class="car-v">
                                <div class="c-el guba_top">
                                    <img :src="'./img/car/guba1.svg'" alt="car" />
                                </div>
                                <!-- -->
                                <div class="c-el morda_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.morda_top.type) +
                        'morda1.svg'
                      " alt="car" />
                                    <div class="e-point-hand point" @click="point('morda_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el fara_top_left">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.fara_top_left.type) +
                        'fara.svg'
                      " @click="point('fara_top_left')" alt="car" />
                                    <div class="e-point-hand point" @click="point('fara_top_left')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el fara_top_right">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.fara_top_right.type) +
                        'fara.svg'
                      " @click="point('fara_top_right')" alt="car" />
                                    <div class="e-point-hand point" @click="point('fara_top_right')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el polosa_top">
                                    <img :src="'./img/car/polosa.svg'" alt="car" />
                                    <div class="">
                                        <span>+</span>
                                    </div>
                                </div>

                                <div class="c-el kapot">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.kapot.type) +
                        'kapot.svg'
                      " @click="point('kapot')" alt="car" />
                                    <div class="e-point-hand point" @click="point('kapot')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el lobash_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.lobash_top.type) +
                        'lobash_top.svg'
                      " @click="point('lobash_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('lobash_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-el top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.top.type) +
                        'top.svg'
                      " @click="point('top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el lobash_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.lobash_bottom.type) +
                        'lobash_bottom.svg'
                      " @click="point('lobash_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('lobash_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el bagaj">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.bagaj.type) +
                        'bagaj.svg'
                      " @click="point('bagaj')" alt="car" />
                                    <div class="e-point-hand point" @click="point('bagaj')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el polosa_bottom">
                                    <img :src="'./img/car/polosa.svg'" alt="car" />
                                    <div class="">
                                        <span>+</span>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="c-el morda_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.morda_bottom.type) +
                        'morda1.svg'
                      " @click="point('morda_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('morda_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el fara_bottom_left">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.fara_bottom_left.type) +
                        'fara.svg'
                      " @click="point('fara_bottom_left')" alt="car" />
                                    <div class="e-point-hand point" @click="point('fara_bottom_left')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el fara_bottom_right">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.fara_bottom_right.type) +
                        'fara.svg'
                      " @click="point('fara_bottom_right')" alt="car" />
                                    <div class="e-point-hand point" @click="point('fara_bottom_right')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- -->

                                <div class="c-el guba_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.guba_bottom.type) +
                        'guba1.svg'
                      " @click="point('guba_bottom')" alt="car" />
                                    <div class="">
                                        <span>+</span>
                                    </div>
                                </div>

                                <div class="c-el krilo_left_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.krilo_left_top.type) +
                        'krilo_left_top.svg'
                      " @click="point('krilo_left_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('krilo_left_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el koleso_left_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.koleso_left_top.type) +
                        'koleso.svg'
                      " @click="point('koleso_left_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('koleso_left_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_left_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.stoika_left_top.type) +
                        'stoika_left_top.svg'
                      " @click="point('stoika_left_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_left_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el steklo_left_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.steklo_left_top.type) +
                        'steklo_left_top.svg'
                      " @click="point('steklo_left_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('steklo_left_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el dver_left_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.dver_left_top.type) +
                        'dver.svg'
                      " @click="point('dver_left_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('dver_left_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el zerkalo_left">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.zerkalo_left.type) +
                        'zerkalo_left.svg'
                      " @click="point('zerkalo_left')" alt="car" />
                                    <div class="e-point-hand point" @click="point('zerkalo_left')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el porog_left">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.porog_left.type) +
                        'porog_left.svg'
                      " @click="point('porog_left')" alt="car" />
                                    <div class="e-point-hand point" @click="point('porog_left')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_left">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.porog_left.type) +
                        'stoika.svg'
                      " @click="point('stoika_left')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_left')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el steklo_left_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.steklo_left_bottom.type) +
                        'steklo_left_bottom.svg'
                      " @click="point('steklo_left_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('steklo_left_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el dver_left_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.dver_left_bottom.type) +
                        'dver.svg'
                      " @click="point('dver_left_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('dver_left_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_left_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.stoika_left_bottom.type) +
                        'stoika_left_bottom.svg'
                      " @click="point('stoika_left_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_left_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el krilo_left_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.krilo_left_bottom.type) +
                        'krilo_left_bottom.svg'
                      " @click="point('krilo_left_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('krilo_left_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el koleso_left_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.koleso_left_bottom.type) +
                        'koleso.svg'
                      " @click="point('koleso_left_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('koleso_left_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="c-el krilo_right_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.krilo_right_top.type) +
                        'krilo_right_top.svg'
                      " @click="point('krilo_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('krilo_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el koleso_right_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.koleso_right_top.type) +
                        'koleso.svg'
                      " @click="point('koleso_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('koleso_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_right_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.stoika_right_top.type) +
                        'stoika_right_top.svg'
                      " @click="point('stoika_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el steklo_right_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.steklo_right_top.type) +
                        'steklo_right_top.svg'
                      " @click="point('steklo_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('steklo_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el dver_right_top">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.dver_right_top.type) +
                        'dver.svg'
                      " @click="point('dver_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('dver_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el zerkalo_right">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.zerkalo_right.type) +
                        'zerkalo_left.svg'
                      " @click="point('dver_right_top')" alt="car" />
                                    <div class="e-point-hand point" @click="point('dver_right_top')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_right">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.stoika_right.type) +
                        'stoika.svg'
                      " @click="point('stoika_right')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_right')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el porog_right">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.porog_right.type) +
                        'porog_right.svg'
                      " @click="point('porog_right')" alt="car" />
                                    <div class="e-point-hand point" @click="point('porog_right')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el steklo_right_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.steklo_right_bottom.type) +
                        'steklo_right_bottom.svg'
                      " @click="point('steklo_right_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('steklo_right_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el dver_right_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.dver_right_bottom.type) +
                        'dver.svg'
                      " @click="point('dver_right_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('dver_right_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el stoika_right_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.stoika_right_bottom.type) +
                        'stoika_right_bottom.svg'
                      " @click="point('stoika_right_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('stoika_right_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el krilo_right_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.krilo_right_bottom.type) +
                        'krilo_right_bottom.svg'
                      " @click="point('krilo_right_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('krilo_right_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="c-el koleso_right_bottom">
                                    <img :src="
                        './img/car/' +
                        get_color_car(list.block.koleso_right_bottom.type) +
                        'koleso.svg'
                      " @click="point('koleso_right_bottom')" alt="car" />
                                    <div class="e-point-hand point" @click="point('koleso_right_bottom')">
                                        <div class="e-point vipoint">
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end car rrr-->
            </div>
            <!--
            <div class="d_car_config">
                <img :src="'./img/dlist/bl_err_demo.svg'" style="max-width:99%; margin:auto;" alt="demo" />
            </div>
            -->
            <!-- -->
            <div class="d_car_damage_list" v-if="pic_damage_v2()">
                <div class="dist_table_header">Фотографии повреждений</div>
                <div class="d_informer_photo">
                    <div :key="kd" v-for="(vf, kd) in list.block">
                        <div class="e_pic_v1" v-if="vf.img != ''" @click="show_galery(list.block, kd)" :style="'background-image: url(' + vf.img + ');'"></div>
                    </div>
                </div>
            </div>
            <!-- -->
        </div>
        <!-- -->

        <div class="dlist_hr_v2">
            <hr />
        </div>
        <!-- -->

        <div class="d_container dlist_check_auto" v-if="convert_tester(list.equipment_tests).length != 0">
            <div class="dist_table_header" style="font_size: 25px">
                Проверка автомобиля
            </div>
            <div class="d_inform_car">
                Проверка производится экспертом перед <br />автомобилем.
            </div>
            <div class="dlist_check_point" :key="kt" v-for="(vt, kt) in convert_tester(list.equipment_tests)">
                <div class="dlist_check_title" v-html="vt.name">Работа акпп/мкпп</div>
                <div class="dlist_check_list" :key="kti" v-for="(vti, kti) in vt.list">
                    <div class="dlist_check_status">
                        <img :src="'./img/dlist/' + vti.img + '.svg'" alt="" />
                    </div>
                    <div class="dlist_check_text" v-html="vti.name">
                        При переключении передач на месте без замечаний
                    </div>
                </div>
            </div>
        </div>

        <div class="dlist_hr_v2" v-if="convert_tester(list.equipment_tests).length != 0">
            <hr />
        </div>
        <!-- -->

        <div class="d_container dlist_check_auto" v-if="convert_tester(list.equipment_salon_tests).length != 0">
            <div class="dist_table_header" style="font_size: 25px">
                Проверка салона
            </div>
            <div class="d_inform_car">
                Проверка производится экспертом перед <br />автомобилем.
            </div>
            <div class="dlist_check_point" :key="kt" v-for="(vt, kt) in convert_tester(list.equipment_salon_tests)">
                <div class="dlist_check_title" v-html="vt.name">Работа акпп/мкпп</div>
                <div class="dlist_check_list" :key="kti" v-for="(vti, kti) in vt.list">
                    <div class="dlist_check_status">
                        <img :src="'./img/dlist/' + vti.img + '.svg'" alt="" />
                    </div>
                    <div class="dlist_check_text" v-html="vti.name">
                        При переключении передач на месте без замечаний
                    </div>
                </div>
            </div>
        </div>

        <!--  -->
        <div class="dlist_hr_v2" v-if="convert_tester(list.equipment_salon_tests).length != 0">
            <hr />
        </div>

        <div class="d_container dlist_check_auto" v-if="convert_tester(list.equipment_salon_tests).length != 0">
            <div class="dist_table_header" style="font_size: 25px">
                Результаты компьютерной диагностики
            </div>

            <div class="d_informer_photo">
                <div :key="kd" v-for="(vf, kd) in list.photo_list_diagnost">
                    <div class="e_pic_v1" v-if="vf.img != ''" @click="show_galery(list.photo_list_diagnost, kd)" :style="'background-image: url(' + vf.img + ');'"></div>
                </div>
            </div>
            <div class="dist_table_header" style="font_size: 25px" v-if="list.comment_diagnost != ''">
                Комментарии диагностики
            </div>

            <span v-html="list.comment_diagnost"></span>
        </div>

        <div class="dlist_hr_v2" v-if="list.photo_list_diagnost.length != 0 || list.comment_diagnost !=''">
            <hr />
        </div>

        <div class="d_container dlist_video" v-if="list.video_list.review.url.length > 2">
            <div class="dlist_check_title video_title">Видео осмотра</div>
            <div class="d_inform_car" style="margin-bottom: 12px">
                Съемка видео производится по регламенту.
            </div>
            <video controls="controls" :poster="'./img/dlist/def.jpeg'" width="100%" height="200">
                <source :src="list.video_list.review.url" type="video/mp4" />
            </video>
        </div>
        <!-- -->
        <!--  -->

        <div class="d_container dlist_video" style="padding-top: 10px" v-if="list.video_list.test_drive.url.length > 2">
            <div class="dlist_check_title video_title">Видео тест-драйва</div>
            <div class="d_inform_car" style="margin-bottom: 12px">
                Съемка видео производится по регламенту.
            </div>
            <video controls="controls" :poster="'./img/dlist/def.jpeg'" width="100%" height="200">
                <source :src="list.video_list.test_drive.url" type="video/mp4" />
            </video>
        </div>
        <!--  -->

        <div class="dlist_hr_v2" v-if="list.video_list.test_drive.url.length > 2">
            <hr />
        </div>

        <div class="d_container dlist_video" style="padding-top: 10px" v-if="list.video_list.start.url.length > 2">
            <div class="dlist_check_title video_title">Видео "Запуск двигателя"</div>
            <div class="d_inform_car" style="margin-bottom: 12px">
                Съемка видео производится по регламенту.
            </div>
            <video controls="controls" :poster="'./img/dlist/def.jpeg'" width="100%" height="200">
                <source :src="list.video_list.start.url" type="video/mp4" />
            </video>
        </div>
        <!--  -->

        <div class="dlist_hr_v2" v-if="list.video_list.start.url.length > 2">
            <hr />
        </div>

        <div class="d_container dlist_video" style="padding-top: 10px" v-if="list.video_list.vihlop.url.length > 2">
            <div class="dlist_check_title video_title">Видео "Выхлоп"</div>
            <div class="d_inform_car" style="margin-bottom: 12px">
                Съемка видео производится по регламенту.
            </div>
            <video controls="controls" :poster="'./img/dlist/def.jpeg'" width="100%" height="200">
                <source :src="list.video_list.vihlop.url" type="video/mp4" />
            </video>
        </div>
        <!--  -->

        <div class="dlist_hr_v2" v-if="list.video_list.vihlop.url.length > 2">
            <hr />
        </div>

        <!-- -->
        <div class="d_container dlist_plus_minus" v-if="
          convert_pl_v2(list.equipment_check_pl).length != 0 ||
          convert_pl_v2(list.equipment_check_pl, 2).length != 0
        ">
            <div class="dlist_check_title video_title">
                Плюсы и минусы автомобиля
            </div>
            <div class="d_inform_car" style="margin-bottom: 10px">
                Данные пункты выставляются автоматически на основе заполненного отчета
            </div>
            <div class="dlist_block">
                <!--<div class="dist_table_header green">Плюсы</div>-->
                <div class="dlist_check_list" :key="kp" v-for="(vp, kp) in convert_pl_v2(list.equipment_check_pl)">
                    <div class="dlist_check_status">
                        <img :src="'./img/dlist/ok.svg'" alt="" />
                    </div>
                    <div class="dlist_check_text" v-html="vp"></div>
                </div>
            </div>
            <div class="dlist_hr_v3" v-if="convert_pl_v2(list.equipment_check_pl).length != 0">
                <hr />
            </div>

            <div class="dlist_block">
                <!--<div class="dist_table_header red">Минусы</div>-->
                <div class="dlist_check_list" :key="kp" v-for="(vp, kp) in convert_pl_v2(list.equipment_check_pl, 2)">
                    <div class="dlist_check_status">
                        <img :src="'./img/dlist/err.svg'" alt="" />
                    </div>
                    <div class="dlist_check_text" v-html="vp">Минус</div>
                </div>
            </div>
        </div>

        <!-- -->

        <div class="dlist_hr_v2" v-if="
          convert_pl_v2(list.equipment_check_pl).length != 0 ||
          convert_pl_v2(list.equipment_check_pl, 2).length != 0
        ">
            <hr />
        </div>

        <!-- -->

        <div class="d_container dlist_check_auto" v-if="convert_checker(list.equipment_check).length > 0">
            <div class="dlist_check_point">
                <div class="dlist_check_title" style="padding-bottom: 5px">
                    Комплектация
                </div>
                <div class="dlist_check_list" :key="kk" v-for="(vk, kk) in convert_checker(list.equipment_check)">
                    <div class="dlist_check_status">
                        <img :src="'./img/dlist/ok.svg'" alt="" />
                    </div>
                    <div class="dlist_check_text" v-html="vk.name">
                        При переключении передач на месте без замечаний
                    </div>
                </div>
            </div>
        </div>
        <!-- -->

        <div class="d_container dlist_check_auto" v-if="list.comment.length > 0">
            <div class="dlist_check_point">
                <div class="dlist_check_title" style="padding-bottom: 0px">
                    Комментарий эксперта
                </div>
                <span v-html="list.comment"> </span>
            </div>
        </div>

        <div class="d_galery" v-show="d_galery.show">
            <div class="d_galery_title row">
                <div class="col-3">
                    <div class="d_g_back" @click="close_galery()">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492 492" style="enable-background: new 0 0 492 492" xml:space="preserve">
                            <g>
                                <g>
                                    <path fill="#fff" d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12

C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084

c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864

l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z" />
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
                <div></div>
            </div>
            <div class="d_gallery_carusel">
                <div class="d_g_carusel">
                    <div class="d_g_container" v-for="(v, k) in d_galery.list" :key="k">
                        <div v-if="v.img != ''" class="d_g_point_carusel" :style="'background-image: url(' + v.img + '); width:'+photo_wi+';padding:10px; margin-rigth:10px;'"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style lang="">
.dlist_main {
    margin: auto;
    min-width: 365px;
    font-family: "Jost-Light", sans-serif !important;
    /*padding: 0px 10px 0px 10px;*/
}

.d_container {
    padding: 0px 20px 0px 20px;
    margin: auto;
}

.d_container_g {
    padding: 0px 0px 0px 20px;
    margin: auto;
}

.d_header {
    line-height: 1.2em;
}

.d_header>h2 {
    font-size: 24px;
    font-weight: bold;
}

.d_header>p {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 5px;
}

.d_header>span {
    color: #7e7979;
    font-size: 14px;
}

.d_informer_photo {
    width: 100%;
    height: 255px;
    background-image: url("#");
    background-position: center;
    background-size: cover;
    margin-top: 10px;
    display: -ms-flexbox;
    display: flex;
    overflow: auto;
}

.e_pic_v1 {
    width: 95%;
    height: 235px;
    border-radius: 10px;
    min-width: 310px;
    background-size: cover;
    background-position: center;
    margin-right: 10px;
}

.d_block_expert_time {
    padding: 5px 20px 10px 20px;
    color: #7e7979;
    font-size: 16px;
    height: 10px;
}

.d_expert {
    float: left;
}

.d_time {
    float: right;
}

.d_ots {
    background-color: #bdbaba;
    width: 100%;
    height: 1px;
    margin-top: 20px;
    margin-bottom: 20px;
}

.dlist_hr {
    width: 99%;
    margin: auto;
}

.dlist_hr>hr {
    background-color: #e9e9e9;
    color: #e9e9e9;
}

.dlist_hr_v3 {
    width: 99%;
    margin: auto;
}

.dlist_hr_v3>hr {
    background-color: #e9e9e9;
    color: #e9e9e9;
    margin-top: 10px;
    margin-bottom: 10px;
}

.dlist_hr_v2 {
    width: 99%;
    margin: auto;
}

.dlist_hr_v2>hr {
    background-color: #e9e9e9;
    color: #e9e9e9;
    height: 10px;
    height: 10px;
    border-top: none;
}

.dlist_table {
    margin-bottom: 15px;
}

.dlist_table_container {
    width: 100%;
    display: flex;
    padding-top: 3px;
}

.dlist_table_container>img {
    max-width: 19px;
}

.dlist_table_block_v1 {
    width: 50%;
    overflow: hidden;
    white-space: pre-line;
}

.dlist_table_block_v2_l {
    width: 8%;
    overflow: hidden;
    white-space: pre-line;
}

.dlist_table_block_v2_l>img {
    width: 20px;
}

.dlist_table_block_v2_r {
    width: 90%;
    overflow: hidden;
    white-space: pre-line;
}

.dlist_table_block_v2_r>img {
    width: 20px;
}

.dist_table_header {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    padding-bottom: 0px;
}

.dlist_informer_gray_text {
    font-size: 14px;
    color: #b5b5b5;
}

.dlist_informer_black_text {
    font-size: 14px;
    color: #000;
    padding-left: 5px;
}

.dlist_informer_green_text {
    font-size: 20px;
    color: #bed134;
}

.btn_gray {
    color: #fff;
    background-color: #b6b6b6;
    width: 100%;
    text-align: center;
    cursor: pointer;
    padding: 10px 10px 10px 10px;
    border-radius: 10px;
}

.btn_green {
    color: #fff;
    background-color: #20b12e;
    width: 100%;
    text-align: center;
    cursor: pointer;
    padding: 10px 10px 10px 10px;
    border-radius: 10px;
}

.d_inform_car {
    font-size: 12px;
    color: #7e7979;
}

.d_car_config {
    padding-bottom: 20px;
}

.dist_table_header {
    font-size: 20px;
    font-weight: bold;
    color: #000;
    padding-bottom: 5px;
}

.dlist_check_title {
    font-weight: bold;
    font-size: 18px;
    padding-bottom: 10px;
}

.dlist_check_status>img,
svg {
    height: 15px;
    margin-top: -6px;
}

.dlist_check_list {
    display: flex;
    padding-bottom: 2px;
}

.dlist_check_status {
    width: 30px;
}

.dlist_check_text {
    font-size: 14px;
}

.d_inform_car_video {
    margin-bottom: 10px;
}

.dlist_video {
    padding-top: 0px;
}

.dlist_video>video {
    border-radius: 10px;
}

.video_title {
    padding-bottom: 5px !important;
}

ul {
    padding-left: 15px;
}

.dlist_ul>li {
    color: #bed134;
    padding-bottom: 5px;
}

.dlist_ul>li>span {
    font-size: 16px;
    color: #000;
}

.green {
    color: #bed134;
}

.red {
    color: #d13434;
}

.d_car_c_v1 {
    height: 445px;
}

.e-point-hand {
    display: none;
}

.view_img {
    position: absolute;
    z-index: 9999;
    width: 90%;
    height: 450px;
    background: #fff;
}

.view_img_close {
    text-align: center;
    font-size: 12px;
    cursor: pointer;
}

.view_img_img {
    height: 300px;
    text-align: center;
}

.view_img_img>img {
    margin: auto;
    max-width: 100%;
    max-height: 100%;
}

.view_img_text {
    font-size: 14px;
}

.dlist_check_point {
    padding-bottom: 15px;
}

.d_galery {
    position: fixed;
    z-index: 99999;
    min-height: 370px;
    height: 100%;
    background: #2f2f2f;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
}

.d_galery_title {
    width: 100%;
    height: 10%;
    min-height: 50px;
    text-align: center;
    color: #fff;
}

.d_g_photo>img {
    width: 100%;
    height: 100%;
}

.d_gallery_carusel {
    width: 100%;
    height: 80%;
    min-height: 100px;
}

.d_gallery_menu {
    width: 100%;
    height: 10%;
    min-height: 50px;
}

.d_g_carusel {
    width: 100%;
    height: 100%;
    background-image: url("#");
    background-position: center;
    background-size: cover;
    margin-top: 10px;
    display: -ms-flexbox;
    display: flex;
    overflow: auto;
}

.d_g_point_carusel {
    width: 100%;
    height: 100%;
    min-width: 375px;
    background-size: contain;
    background-position: center;
    background-image: url("#");
    background-repeat: no-repeat;
    margin-left: 5px;
}

.d_g_back {
    padding: 20px 20px 20px 20px;
}

.d_g_container {}
</style>

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
            photo_wi: '375px',
            see_car_info: {
                text: "",
                img: "",
            },
            d_galery: {
                list: [],
                show: false,
                index: 0,
            },
            damage_car_img: [],
            show_car_info: false,
            block: {
                def: {},
                morda_top: {},
                fara_top_left: {},
                fara_top_right: {},
                kapot: {},
                lobash_top: {},
                top: {},
                lobash_bottom: {},
                bagaj: {},
                polosa_bottom: {},
                morda_bottom: {},
                fara_bottom_left: {},
                fara_bottom_right: {},
                guba_bottom: {},
                krilo_left_top: {},
                koleso_left_top: {},
                stoika_left_top: {},
                steklo_left_top: {},
                dver_left_top: {},
                zerkalo_left: {},
                porog_left: {},
                stoika_left: {},
                steklo_left_bottom: {},
                dver_left_bottom: {},
                stoika_left_bottom: {},
                krilo_left_bottom: {},
                koleso_left_bottom: {},
                krilo_right_top: {},
                koleso_right_top: {},
                stoika_right_top: {},
                steklo_right_top: {},
                dver_right_top: {},
                zerkalo_right: {},
                stoika_right: {},
                porog_right: {},
                steklo_right_bottom: {},
                dver_right_bottom: {},
                stoika_right_bottom: {},
                krilo_right_bottom: {},
                koleso_right_bottom: {},
            },
            block_name: {
                def: "Стандарт",
                morda_top: "Передняя часть",
                fara_top_left: "Передняя левая фара",
                fara_top_right: "Передняя правая фара",
                kapot: "Капот",
                lobash_top: "Лобовое переднее",
                top: "Крыша",
                lobash_bottom: "Лобовое заднее",
                bagaj: "Багажник",
                polosa_bottom: "",
                morda_bottom: "Задняя часть",
                fara_bottom_left: "Задняя левая фара",
                fara_bottom_right: "Задняя правая фара",
                guba_bottom: "",
                krilo_left_top: "Переднее левое крыло",
                koleso_left_top: "Переднее левое колесо",
                stoika_left_top: "Передняя левая стойка",
                steklo_left_top: "Переднее левое стекло",
                dver_left_top: "Передняя левая дверь",
                zerkalo_left: "Левое зеркало",
                porog_left: "Порог левый",
                stoika_left: "Левая стойка",
                steklo_left_bottom: "Заднее левое стекло",
                dver_left_bottom: "Задняя левая дверь",
                stoika_left_bottom: "Задняя левая стойка",
                krilo_left_bottom: "Заднее крыло",
                koleso_left_bottom: "Заднее левое колесо",
                krilo_right_top: "Переднее правое крыло",
                koleso_right_top: "Правое переднее колесо",
                stoika_right_top: "Правая передняя стойка",
                steklo_right_top: "Правое переднее стекло",
                dver_right_top: "Правая передняя дверь",
                zerkalo_right: "Правое зеркало",
                stoika_right: "Правая стройка",
                porog_right: "Порог правый",
                steklo_right_bottom: "Правое заднее стекло",
                dver_right_bottom: "Правая задняя дверь",
                stoika_right_bottom: "Правая задняя стойка",
                krilo_right_bottom: "Правое заднее крыло",
                koleso_right_bottom: "Правое заднее колесо",
            },
            defcar: {
                prefix: "",
                name: "",
                comment: "",
                type: 0,
                img: "",
                /*list:[
                                        {
                                            img:'',
                                            text:'',
                                            status:''
                                        }
                                    ]*/
            },
            use_element_car: "def",
            show_menu_car: false,
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
                        {
                            name: "Кузов",
                            field: ["body"],
                        },
                        {
                            name: "Модификация",
                            field: ["size_engine", "type_engine", "power"],
                        },
                        {
                            name: "Руль",
                            field: ["type_wheel"],
                        },
                        {
                            name: "Коробка",
                            field: ["type_transmission"],
                        },
                        {
                            name: "Привод",
                            field: ["type_drive"],
                        },
                        {
                            name: "Салон",
                            field: ["type_interior"],
                        },
                        {
                            name: "Цвет салон",
                            field: ["color_salon"],
                        },
                        {
                            name: "Пробег",
                            field: ["range"],
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
                            name: "Номер ПТС",
                            field: ["pts_number"],
                        },
                        {
                            name: "Дата выдачи ПТС",
                            field: ["date_pts"],
                        },
                        {
                            name: "Кол-во хозяев по ПТС",
                            field: ["count_owner"],
                        },
                        {
                            name: "Свободных мест в ПТС",
                            field: ["free_space"],
                        },
                        {
                            name: "Номер СТС",
                            field: ["sts_number"],
                        },
                        {
                            name: "Дата выдачи СТС",
                            field: ["date_sts"],
                        },
                    ],
                },

                {
                    name: "Дополнительно",
                    list: [{
                            name: "Сервисная книжка",
                            field: ["service_book"],
                        },
                        {
                            name: "На гарантии",
                            field: ["guarantee"],
                        },
                        {
                            name: "Продавец",
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
                        /*{
                                                    name: "Битый",
                                                    field: ["damage"],
                                                },*/
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
            return "background-image: url(" + d + ");";
        },
        /**
         * @var d array
         */
        convert_pl: function (d) {
            var p = [];
            var m = [];
            console.log("convert_pl");
            console.log(d);
            console.log(typeof d);
            if (!(typeof d == "object" || typeof d == Array)) {
                d = [];
            }
            //if (typeof d == "Object" || typeof d == "Array") {
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
            //}

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
        convert_pl_v2: function (d, typer = 1) {
            var p = [];
            var m = [];
            if (!(typeof d == "object" || typeof d == Array)) {
                d = [];
            }
            //if (typeof d == "Object" || typeof d == "Array") {
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
            //}
            return typer == 1 ? p : m;
        },
        convert_tester: function (d) {
            var l = []; // собираю список
            var t = []; // собираю тайтл
            var r = []; // результат
            var s = -1; // поисковой индекс
            var config_name_img = {
                name: "",
                img: "",
            };
            if (typeof d == "object" || typeof d == Array) {
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
                            config_name_img = this.get_name_img_procent_test(
                                d[i].id,
                                d[i].val.id,
                                d[i].name
                            );
                            l[s].push({
                                name: config_name_img.name + d[i].name,
                                status: d[i].val.id,
                                img: /*d[i].val.id == 1 ? "ok" : "err"*/ config_name_img.img,
                            });
                        }
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
        get_name_img_procent_test: function (id, imgid, name) {
            var ename = this.get_name_procent_test(id);
            var eimg = "";
            if (ename == "") {
                eimg = imgid == 1 ? "ok" : "err";
            } else {
                if (parseInt(name) > 20) {
                    eimg = "ok";
                } else {
                    eimg = "err";
                }
            }

            return {
                name: ename,
                img: eimg,
            };
        },
        use_procent: function (q) {
            for (var i = 0; i < 100; i = i + 5) {
                if (q == i + "%") {
                    return true;
                }
            }

            return false;
        },
        get_name_procent_test: function (q) {
            switch (q) {
                case "1144":
                    return "Остаток шин: ";
                case "1143":
                    return "Остаток ЗТД: ";
                case "1142":
                    return "Остаток ЗТК: ";
                case "1141":
                    return "Остаток ПТД: ";
                case "1140":
                    return "Остаток ПТК: ";
                default:
                    return "";
            }

            return "";
        },
        convert_checker: function (data) {
            var list = [];

            if (typeof data == "object" || typeof data == Array) {
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
            }

            return list;
        },
        get_data_table: function (n) {
            var c = "";

            if (n.length > 0) {
                if (typeof n == Array || typeof n == "object") {
                    //if (n != [])
                    console.log("length");
                    console.log(n.length);
                    for (var i = 0; i < n.length; i++) {
                        if (
                            n[i] == "date_end" ||
                            n[i] == "date_pts" ||
                            n[i] == "date_sts"
                        ) {
                            if (new Date(this.list[n[i]]) != "Invalid Date") {
                                var date = new Date(this.list[n[i]]);

                                c =
                                    c +
                                    (date.getDate() < 10 ? "0" : "") +
                                    date.getDate() +
                                    "." +
                                    (date.getMonth() + 1 < 10 ? "0" : "") +
                                    (date.getMonth() + 1) +
                                    "." +
                                    date.getFullYear() +
                                    " ";
                            } else {}
                        } else {
                            c =
                                c +
                                this.vi(this.list[n[i]]) +
                                (n[i] == "power" ? "л.с." : "") +
                                (n.length > 1 ? "/" : "");
                        }
                    }
                } else {
                    c = c + this.vi(this.list[n]) + (n.length > 1 ? "/" : "");
                }
            }

            if (c.replace(/\s+/g, "").replace(/\//g, "") == "") {
                return "";
            }
            if (c.toString().slice(-1) == "/") {
                return c.toString().slice(0, -1);
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
                        if (t["name"] == undefined) {
                            return t;
                        }
                        return t["name"];
                    }
                }
            }

            if (t == "" || t == undefined) {
                return "";
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

        /**
         * @var d date {string, object}
         *
         * @return string date or emp string
         */
        convert_date: function (d) {
            d = new Date(d);
            if (d != "Invalid Date") {
                return d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear();
            }

            return this.emp();
        },

        get_color_car: function (t) {
            if (t == 2) {
                return "yelow/";
            }
            if (t == 1 || t == 3 || t == 4) {
                return "red/";
            }

            return "";
        },
        point: function (t) {
            if (this.list.block[t].type != 0) {
                this.show_car_info = true;
                this.see_car_info.text = this.list.block[t].comment;
                this.see_car_info.img = this.list.block[t].img;
            }
        },
        show_car: function () {
            if (
                typeof this.list["block"] == "object" ||
                typeof this.list["block"] == Array
            ) {
                return true;
            }

            return false;
        },
        pic_damage_v2: function () {
            for (var key in this.list.block) {
                if (this.list.block[key].img.length > 0) {
                    return true;
                }
                console.log(this.list.block[key].img);
            }

            return false;
        },
        show_galery: function (list, k) {
            this.d_galery.list = list;
            this.d_galery.show = true;
        },
        close_galery: function () {
            this.d_galery.list = [];
            this.d_galery.show = false;
        },
    },
    watch: {
        'd_galery.show': function (t) {
            console.log('eeee');
            console.log(t);
            if (t) {
                var vm = this;
                var d_g_c = document.querySelector('body').offsetWidth;
                if (d_g_c > 380) {
                    setTimeout(function () {
                        vm.photo_wi = (d_g_c - 25) + 'px';
                    }, 10);
                    //
                }
                console.log('-->>' + d_g_c);
            }
        }
    }
};
</script>
