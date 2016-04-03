<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <div>
        <?=$this->session->flashdata('team');?>
    </div>
    <div>
        <fieldset>
            <form action="" method="get">
                <label>Избери Отбор
                    <select name="team_id">
                        <option value=""></option>
                        <? $country=0;$openTag=false; ?>
                        <?php foreach($teams as $team) : ?>
                            <?php if($team->country_id!=$country) {
                                $country=$team->country_id;
                                if(!$openTag){
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }else{
                                    echo '<//optgroup>';
                                    echo '<optgroup label="'.$team->country_name.'">';
                                    $openTag=true;
                                }

                            }
                            ?>
                            <option value="<?php echo $team->id ?>" <?php echo ($team_id==$team->id)?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>

                    </select>
                    <label><select  name="pos"  >
                            <option value=""  ><--Избери позиция--></option>
                            <option value="G" <?php echo ($pos=="G")?'selected': ''?> >Вратари</option>
                            <option value="D" <?php echo ($pos=="D")?'selected': ''?> >Защитници</option>
                            <option value="M" <?php echo ($pos=="M")?'selected': ''?> >Полузащитници</option>
                            <option value="F" <?php echo ($pos=="F")?'selected': ''?> >Нападатели</option>
                        </select> </label>

                </label>
                <label for="">per Page:
                    <select  name="perPage">
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
    <div><button ><a href="<?=base_url();?>player/create">Въведи нов състезател</a></button></div>
    <div>
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th><a href="<?=base_url()?>player/index/last_name/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Име</a></th>
            <th><a href="<?=base_url()?>player/index/country/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Country</a></th>
            <th><a href="<?=base_url()?>player/index/position_player/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Позиция</a></th>
            <th><a href="<?=base_url()?>player/index/team_id/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Отбор</a></th>
            <th><a href="<?=base_url()?>player/index/games/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Мачове</a></th>
            <th><a href="<?=base_url()?>player/index/goals/<?=($sortOrder=='asc')?'desc':'asc'?>?team_id=<?=$team_id?>&pos=<?=$pos?>&perPage=<?=$perPage?>&pattern=<?=$pattern?>">Голове</a></th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($players as $player):?>
                <tr>
                    <td><img src="<?=$player->image; ?>" alt="" width="75px" height="75px"></td>
                    <td><?=($player->first_name.' '.$player->last_name); ?></td>
                    <td><?=$player->country; ?></td>
                    <td><?=$player->position_player; ?></td>
                    <td><?=$player->team_name; ?></td>
                    <td><?=$player->games; ?></td>
                    <td><?=$player->goals; ?></td>
                    <td><a href="update/<?=$player->id; ?>">Update</a></td>
                    <td><a href="delete/<?=$player->id; ?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </tboby>
    </table>
<div><?=$pagination?></div>

<?php $this->load->view('admin/include/footer');?>