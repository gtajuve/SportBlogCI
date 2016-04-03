<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <div>
        <?=$this->session->flashdata('team');?>
    </div>
    <div>
        <fieldset>
            <form action="" method="get">
                <label>Избери Страна
                    <select size="1" name="country_id" >
                        <option value="0"  ><--Избери страна--></option>
                        <?php foreach($countrys as $country) : ?>
                            <option value="<?php echo $country->id ;?>" <?= $countryId==$country->id?'selected':'' ;?> ><?php echo $country->country_name;?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label for="">per Page:
                    <select id="selectError3" name="perPage">
                        <option value="0" <?php echo ($perPage == 0)? "selected" : " " ?>>-- Select Order --</option>
                        <option value="5" <?php echo ($perPage == 5)? "selected" : " " ?>>5 per page</option>
                        <option value="10" <?php echo ($perPage == 10)? "selected" : " " ?>>10 per page</option>
                        <option value="20" <?php echo ($perPage == 20)? "selected" : " " ?>>20 per page</option>
                        <option value="50" <?php echo ($perPage == 50)? "selected" : " " ?>>50 per page</option>
                    </select>
                </label>
                <label>Search:
                    <input type="text" name="pattern" value="<?=$pattern?>">
                </label>
                <button type="submit" name="">Filter</button>

            </form>
        </fieldset>
    </div>
    <div><button href=><a href="<?=base_url();?>team/create">Въведи нов отбор</a></button></div>
    <div>
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th><a href="<?=base_url();?>team/index/team_name/<?=$sortOrder=='asc'?'desc':'asc'?>?country_id=<?=$countryId?>&perPage=<?=$perPage?>&pattern=">Name</a></th>
            <th>Country</th>
            <th>Stadium</th>
            <th>Gallery</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($teams as $team):?>
                <tr>
                    <td><img src="<?=$team->image; ?>" alt="" width="50px" height="50px"></td>
                    <td><?=$team->team_name; ?></td>
                    <td><?=$team->country_name; ?></td>
                    <td><?=$team->address; ?></td>
                    <td><a href="<?=base_url()?>image/index/<?=$team->id; ?>">Gallery</a></td>
                    <td><a href="<?=base_url()?>team/update/<?=$team->id; ?>">Update</a></td>
                    <td><a href="<?=base_url()?>team/delete/<?=$team->id; ?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </tboby>
    </table>
   </div>
    <div>
        <?=$pagination; ?>
    </div>

<?php $this->load->view('admin/include/footer');?>