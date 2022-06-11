<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bosh sahifa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card  border-top border-primary shadow-5 mx-0  mb-4">
    <div class="card-header pb-0">
        <h6 class="text-center text-uppercase">Mening arizalarim</h6>
    </div>
    <div class="card-body px-2 pt-0 pb-2">
        <div class="row">
            <div class="col-md-2">
                <div class="PersonImage ">
                    <div class="image card">
                        <img src="<?=(isset($abitur['image']) && $abitur['image'] !='')?'https://files.dtm.uz/'.$abitur['image']:'../img/person.png'?>" style="width:3cm;height:4cm" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-4">
                <div>
                    <div class="text-center font-weight-bold"><i class="fa-solid fa-circle-check text-success"></i>
                        SHAXSIY MA'LUMOTLAR
                    </div>
                </div>
                <table class="table table-bordered border-primary table-sm">
                    <tr>
                        <th>Familiya</th>
                        <td><?=$abitur['lname']?></td>
                    </tr>
                    <tr>
                        <th>Ism</th>
                        <td><?=$abitur['fname']?></td>
                    </tr>
                    <tr>
                        <th>Sharif</th>
                        <td><?=$abitur['mname']?></td>
                    </tr>
                    <tr>
                        <th>Tug‘ilgan sana</th>
                        <td><?=$abitur['bdate']?></td>
                    </tr>
                    <tr>
                        <th>Jinsi</th>
                        <td><?=($abitur['sex']==1)?'Erkak':'Ayol'?></td>
                    </tr>
                    <tr>
                        <th>Millati</th>
                        <td><?=$abitur['nation']?></td>
                    </tr>
                    <tr>
                        <th>Telefon</th>
                        <td><?=$abitur['username']?></td>
                    </tr>
                </table>
                <div>
                    <div class="text-center font-weight-bold"><i class="fa-solid fa-circle-check text-success"></i>
                        DOIMIY YASHASH MANZILI
                    </div>
                </div>
                <table class="table table-bordered border-primary table-sm">
                    <tr>
                        <th>Viloyat</th>
                        <td><?=$abitur['region_name']?></td>
                    </tr>
                    <tr>
                        <th>Tuman</th>
                        <td><?=$abitur['district_name']?></td>
                    </tr>
                    <tr>
                        <th>Manzil</th>
                        <td><?=$abitur['address']?></td>
                    </tr>

                </table>
                <div>
                    <div class="text-center font-weight-bold"><i class="fa-solid fa-circle-check text-success"></i>
                        TUGATGAN TA'LIM MUASSASASI
                    </div>
                </div>
                <table class="table table-bordered border-primary table-sm">
                    <tr>
                        <th>Viloyat</th>
                        <td><?=$abitur['old_edu_region']?></td>
                    </tr>
                    <tr>
                        <th>Tuman</th>
                        <td><?=$abitur['old_edu_disc']?></td>
                    </tr>
                    <tr>
                        <th>Muassasa nomi</th>
                        <td><?=($abitur['is_scholl']==0)?$abitur['maktab']:$abitur['scholl_name']?></td>
                    </tr>
                    <tr>
                        <th>Hujjat seriyasi va raqami	</th>
                        <td>L1234567</td>
                    </tr>

                </table>
                <div>
                    <div class="text-center font-weight-bold"><i class="fa-solid fa-circle-check text-success"></i>
                        TANLANGAN TA'LIM YO‘NALISHLARI
                    </div>
                </div>
                <table class="table table-bordered border-primary table-sm">
                    <tr>
                        <th>Litsey nomi</th>
                        <td><?=$abitur['edu_name']?></td>
                    </tr>
                    <tr>
                        <th>TANLANGAN TA'LIM YO‘NALISHLARI</th>
                        <td><?=$abitur['edu_name']?></td>
                    </tr>
                    <tr>
                        <th>Muassasa nomi</th>
                        <td><?=$abitur['direction_name']?></td>
                    </tr>
                    <tr>
                        <th>Ta'lim tili</th>
                        <td><?=$abitur['lang']?></td>
                    </tr>
                    <tr>
                        <th>Chet tili</th>
                        <td><?=$abitur['flang_name']?></td>
                    </tr>

                </table>
                <div>
                    <div class="text-center font-weight-bold"><i class="fa-solid fa-circle-check text-success"></i>
                        File
                    </div>
                </div>
                <table class="table table-bordered border-primary table-sm">
                    <tr>
                        <th>Shaxodatnoma rasmi</th>
                        <td>
                            <?php if ($abitur['image_shaxodatnoma'] !=''):?>
                            <span>
                                <span class="badge badge-success">Bor</span> <a target="_blank" href="https://files.dtm.uz/'.<?=$abitur['image_shaxodatnoma']?>">File Ko'rish</a>
                            </span>
                            <?php else:?>
                                <span class="badge badge-danger">Yo'q</span>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Chet tili sertifikati rasmi</th>
                        <td>
                            <?php if ($abitur['image_cert'] !=''):?>
                                <span>
                                <span class="badge badge-success">Bor</span> <a target="_blank" href="https://files.dtm.uz/'.<?=$abitur['image_cert']?>">File Ko'rish</a>
                            </span>
                            <?php else:?>
                                <span class="badge badge-danger">Yo'q</span>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Olimpiyada sertifikati rasmi</th>
                        <td>
                            <?php if ($abitur['image_olympic'] !=''):?>
                                <span>
                                <span class="badge badge-success">Bor</span> <a target="_blank" href="https://files.dtm.uz/'.<?=$abitur['image_olympic']?>">File Ko'rish</a>
                            </span>
                            <?php else:?>
                                <span class="badge badge-danger">Yo'q</span>
                            <?php endif ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
