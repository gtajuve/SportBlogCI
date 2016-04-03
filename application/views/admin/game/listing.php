<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <div>
        <fieldset>
            <form action="" method="get">
                <label>Избери Отбор
                    <select name="team_id1">
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
                            <option value="<?php echo $team->id ?>" <?php echo ($team_id1==$team->id)?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>

                </select>

                </label>
                <label>Избери Отбор
                    <select name="team_id2">
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
                            <option value="<?php echo $team->id ?>" <?php echo ($team_id2==$team->id)?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>

                    </select>

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

                <button type="submit" name="">Filter</button>

            </form>
        </fieldset>
    </div>
    <div><button href=><a href="<?=base_url();?>game/create">Въведи нов мач</a></button></div>
    <div>
    <table>
        <thead>
        <tr>
            <th><a href="<?=base_url()?>game/index/date_play/<?=($sortOrder=='asc')?'desc':'asc'?>">Дата</a></th>
            <th></th>
            <th>Домакин</th>
            <th>Резултат</th>
            <th>Гост</th>
            <th></th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($games as $game):?>
                <tr>
                    <td><?= date('Y-F-d',(int)$game->date_play); ?></td>
                    <td><img src="<?=$game->home_image; ?>" alt="" width="30px" height="30px"></td>
                    <td><?=$game->home_team; ?></td>
                    <td><a href="<?=base_url()?>roster/index/<?=$game->id; ?>"><?=$game->score; ?></a></td>
                    <td><?=$game->away_team; ?></td>
                    <td><img src="<?=$game->away_image; ?>" alt="" width="30px" height="30px"></td>
                    <td><a href="update/<?=$game->id; ?>">Update</a></td>
                    <td><a href="delete/<?=$game->id; ?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </tboby>
    </table>
<div>
    <?=$pagination?>
</div>

<?php $this->load->view('admin/include/footer');?>