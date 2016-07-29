<nav class="pushmenu pushmenu-left">
    <div class="login">
        <p class="danhmuc">Welcome !</p>
        <p><a href="<?= Yii::$app->homeUrl; ?>site/signin" data-toggle="modal" class="fa fa-sign-in signin"> Đăng nhập </a><i class="fa fa-chevron-right sign-in"></i></p>
        <p><a href="<?= Yii::$app->homeUrl; ?>site/signup" data-toggle="modal" class="fa fa-user-plus signup"> Đăng ký</a><i class="fa fa-chevron-right sign-up"></i></p>
    </div>
    <p class="danhmuc">Danh mục sản phẩm</p>
    <ul class="links">
        <?php
            foreach($listcate as $value){
            ?>
            <li>
                <a href="<?= Yii::$app->homeUrl.'product/listproduct/'.$value->cat_id ?>" title="<?= $value->name ?>">
                    <?php
                    switch ($value->name) {
                        case 'Giấy - Bìa':
                            echo "<i class='tiki-icons glyphicon glyphicon-folder-close'></i>";
                            break;
                        case 'Bút viết các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-pencil'></i>";
                            break;
                        case 'File hồ sơ các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-file'></i>";
                            break;
                        case 'Sổ các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-book'></i>";
                            break;
                        case 'Băng dính các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-fullscreen'></i>";
                            break;
                        case 'Dụng cụ văn phòng':
                            echo "<i class='tiki-icons glyphicon glyphicon-cog'></i>";
                            break;
                        case 'Túi đựng hồ sơ':
                            echo "<i class='tiki-icons glyphicon glyphicon-folder-open'></i>";
                            break;
                        case 'Vật phẩm - Quà tặng':
                            echo "<i class='tiki-icons glyphicon glyphicon-gift'></i>";
                            break;
                        case 'Mực in - Hộp mực':
                            echo "<i class='tiki-icons glyphicon glyphicon-briefcase'></i>";
                            break;
                    }
                    ?>
                    <span><?= $value->name ?></span>
                    <i class="fa fa-chevron-right pull-right"></i>
                </a>

            </li>

            <?php
            }
            ?>
    </ul>
    
</nav>
<div class="col-md-3">
    <div class="category">
        <div class="menu-all">
            <a href="javascript:void(0)" title="Danh mục sản phẩm">
                <i class="fa fa-reorder"></i>
                 Danh mục sản phẩm
            </a>
        </div>
        <ul>
            <?php
            foreach($listcate as $value){
            ?>
            <li>
                <a href="<?= Yii::$app->homeUrl.'product/listproduct/'.$value->cat_id ?>" title="<?= $value->name ?>">
                    <?php
                    switch ($value->name) {
                        case 'Giấy - Bìa':
                            echo "<i class='tiki-icons glyphicon glyphicon-folder-close'></i>";
                            break;
                        case 'Bút viết các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-pencil'></i>";
                            break;
                        case 'File hồ sơ các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-file'></i>";
                            break;
                        case 'Sổ các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-book'></i>";
                            break;
                        case 'Băng dính các loại':
                            echo "<i class='tiki-icons glyphicon glyphicon-fullscreen'></i>";
                            break;
                        case 'Dụng cụ văn phòng':
                            echo "<i class='tiki-icons glyphicon glyphicon-cog'></i>";
                            break;
                        case 'Túi đựng hồ sơ':
                            echo "<i class='tiki-icons glyphicon glyphicon-folder-open'></i>";
                            break;
                        case 'Vật phẩm - Quà tặng':
                            echo "<i class='tiki-icons glyphicon glyphicon-gift'></i>";
                            break;
                        case 'Mực in - Hộp mực':
                            echo "<i class='tiki-icons glyphicon glyphicon-briefcase'></i>";
                            break;
                    }
                    ?>
                    <span><?= $value->name ?></span>
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>