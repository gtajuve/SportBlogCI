<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <form class="form-horizontal" method="post" action="create">
        <fieldset>

            <div class="control-group">
                <label class="control-label" for="inputError">Име</label>
                <div class="controls">
                    <input type="text" id="inputError"name="fname" value=" <?php echo $playerInfo['first_name'] ?>">
                    <span class="help-inline"><?php echo form_error('fname'); ?></span>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="inputError">Фамилия</label>
                <div class="controls">
                    <input type="text" id="inputError" name="lname" value=" <?php echo $playerInfo['last_name'] ?>">
                    <span class="help-inline"><?php echo form_error('lname'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="inputError">Снимка</label>
                <div class="controls">
                    <input type="text" id="inputError" name="imagePlayer" value=" <?php echo $playerInfo['image'] ?>">
                    <span class="help-inline"><?php echo form_error('imagePlayer'); ?></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputError">Националност</label>
                <div class="controls">
                    <input type="text" id="inputError" name="countryPlayer" value=" <?php echo $playerInfo['country'] ?>">
                    <span class="help-inline"><?php echo form_error('countryPlayer'); ?></span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="selectError3">Отбор:</label>
                <div class="controls">
                    <select data-placeholder="Избери Отбор" name="team_id" id="selectError2" data-rel="chosen">
                        <option value=""></option>
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
                            <option value="<?php echo $team->id ?>" <?php echo ($playerInfo['team_id']==$team->id)?'selected': ''?> ><?php echo $team->team_name?></option>

                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="selectError3">Позиция</label>
                <div class="controls">
                    <select name="position" id=selectError3" name="country">
                        <option value="">-- Избери Позиция--</option>
                        <option value="G" <?php echo ("G"==$playerInfo['position_player']?'selected':'') ?> >Вратар</option>
                        <option value="D" <?php echo ("D"==$playerInfo['position_player']?'selected':'') ?> >Защитник</option>
                        <option value="M" <?php echo ("M"==$playerInfo['position_player']?'selected':'') ?> >Полузащитник</option>
                        <option value="F" <?php echo ("F"==$playerInfo['position_player']?'selected':'') ?> >Нападател</option>
                    </select>
                </div>
            </div>
            <div class="control-group >
                <label class="control-label" for="inputError">Мачове</label>
                <div class="controls">
                    <input type="number" id="inputError" name="games" value="<?php echo $playerInfo['games'] ?>">
                    <span class="help-inline"><?php echo form_error('games'); ?></span>
                </div>
            </div>
            <div class="control-group  ">
                <label class="control-label" for="inputError">Голове</label>
                <div class="controls">
                    <input type="number" id="inputError" name="goals" value="<?php echo $playerInfo['goals'] ?>">
                    <span class="help-inline"><?php echo form_error('goals'); ?></span>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                <button class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>

<?php $this->load->view('admin/include/footer');?>