<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
<fieldset>
    <?php echo $error;?>

    <?php echo form_open_multipart('image/do_upload/'.$id);?>

    <input type="file" name="image" size="30" />
    <input type="text" name="title" />
    <br />

    <input type="submit" value="upload" />

</fieldset>

  <?php foreach($images as $image):?>
               <div style="display: inline"><?=$image->title?><img src="<?=base_url()?>uploads/teams/images/<?=$image->image_name?>" alt="">
                   <a href="<?=base_url()?>image/delete/<?=$image->id?>">Delete</a>
               </div>

    <?php endforeach;?>


<?php $this->load->view('admin/include/footer');?>