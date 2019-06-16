<?php include_once('session.php'); ?>
<?php foreach($subcats as $subcategories){ ?>
<br>
<div class="menu_box">
    <!-- Subcategory -->
    <div class="d-inline-flex px-4 animated flipInX slow subcategory mb-2 delius">
        <h5 class="subcategory_label"><?php echo $subcategories->ctName; ?></h5>
    </div>
    <!-- Card group -->
    <div class="d-flex flex-wrap mb-4 menu_group">
        <?php foreach($menu as $items) {
            if($subcategories->ctName == $items->ctName){ ?>
                <!-- Card -->
                <div class="card cd-mw" id="<?php echo $items->mID; ?>">
                    <!-- Card image -->
                    <a href="javascript:void(0)" class="menu_card" id="<?php echo $items->mID; ?>">
                        <?php /*span class="indicate_promo <?php echo $items->mID; ?>" style="position:absolute;right:0;top:0"><img style="width:60px;" src="<?php echo base_url('/assets/media/customer/banner.png')?>"></span*/?>
                        <img data-mID="<?php echo $items->mID; ?>" class="card-img-top" src="
                        <?php
                            if(isset($items->mImage)){
                                echo "".cmedia_url()."menu/".$items->mImage;
                            } else {
                                echo "".cmedia_url()."menu/no_image.jpg";
                            }
                        ?>">
                    </a>
                    <!-- Card content -->
                    <div class="card-body p-0 m-0 gab">
                        <!-- Title -->
                        <p class="text-truncate menu-title" id="mt"><?php echo $items->mName; ?></p>
                        <p class="menu-price" id="mp"><span class="fs-15">₱</span><?php echo $items->prPrice; ?></p>
                    </div>
                </div>
        <?php }} ?>
    </div>
</div>

<?php } ?>

<?php include 'modals/menu_modal.php'; ?>
<?php include 'modals/order_modal.php'; ?>
