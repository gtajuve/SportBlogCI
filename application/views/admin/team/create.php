<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>

    <form  method="post" action="create">
        <fieldset>

            <div>
                <label class="control-label" for="inputError">Име</label>
                    <div>
                    <input type="text" id="inputError"name="name" value="<?php echo $inputData['team_name']?>">
                    <span class="help-inline"><?php echo form_error('name'); ?></span>
                    </div>
            </div>


            <div>
                <label class="control-label" for="inputError">Снимка</label>
                <div>
                    <input type="text" id="inputError" name="image" value="<?php echo $inputData['image']?>">
                    <span class="help-inline"><?php echo form_error('image'); ?></span>
                </div>
            </div>

            <div>
                <label class="control-label" for="inputError">Стадион</label>
                <div>
                    <input type="text" id="inputError" name="address" value="<?php echo ($inputData['address'])?>">
                     <span class="help-inline"><?php echo form_error('address'); ?></span>
                </div>
            </div>

            <div>
                <label class="control-label" for="selectError3">Страна</label>
                <div>
                    <select name="country_id" id=selectError3" >
                        <option value="">-- Избери Страна--</option>
                        <?php foreach($countrys as $country):?>

                            <option value="<?php echo $country->id ?>" <?php echo ($country->id==$inputData['country_id']?'selected':'') ?> ><?php echo $country->country_name ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="change">Save</button>
                <button class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>

<?php $this->load->view('admin/include/footer');?>